<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Generico\Carrito;
use App\Models\Articulo;
use App\Models\Iva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mpdf\Mpdf;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $facturas = $this->getFacturas();
        return view('facturas.index', [
            'facturas' => $facturas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $carrito = Carrito::carrito();
        return view('comprar', [
            'carrito' => $carrito,
        ]);
    }

    public function show($facturaID)
    {

        $factura = Factura::with('articulos', 'articulos.iva')->find($facturaID);

        if (!$factura) {
            session()->flash('error', 'No se encuentra la factura indicada');
            return view('facturas.show');
        }

        $total = 0;
        $base4 = 0;
        $base10 = 0;
        $base21 = 0;
        $por = 0;

        foreach ($factura->articulos as $articulo) {
            $total += $articulo->pivot->cantidad * $articulo->precio;

            $ivaPorcentaje = $articulo->iva->por;
            switch ($ivaPorcentaje) {
                case '21':
                    $base21 += $articulo->pivot->cantidad * $articulo->precio;
                    break;
                case '10':
                    $base10 += $articulo->pivot->cantidad * $articulo->precio;
                    break;
                case '4':
                    $base4 += $articulo->pivot->cantidad * $articulo->precio;
                    break;
            }
        }
        return view('facturas.show', [
            'factura' => $factura,
            'total' => $total,
            'base4' => $base4,
            'base10' => $base10,
            'base21' => $base21,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function realizarCompra(Request $request)
    {
        $carrito = Carrito::carrito();
        DB::beginTransaction();
        $factura = new Factura();
        $factura->user()->associate(Auth::user());
        $factura->save();

        $attachs = [];
        foreach ($carrito->getLineas() as $articulo_id => $linea) {
            $attachs[$articulo_id] = ['cantidad' => $linea->getCantidad()];
        }
        $factura->articulos()->attach($attachs);

        foreach ($carrito->getLineas() as $linea) {
            $articulo = Articulo::find($linea->getArticulo()->id);
            if ($articulo) {
                $articulo->stock -= $linea->getCantidad();
                $articulo->save();
            }
        }
        DB::commit();
        session()->flash('exito', 'La factura se ha generado correctamente');
        session()->forget('carrito');
        return redirect()->route('principal');
    }

    public function getFacturas()
    {
        $facturas = Auth::user()->facturas()
            ->selectRaw('facturas.id, facturas.user_id, facturas.created_at, sum(cantidad * precio) as total')
            ->join('articulo_factura', 'facturas.id', '=', 'articulo_factura.factura_id')
            ->join('articulos', 'articulos.id', '=', 'articulo_factura.articulo_id')
            ->groupBy('facturas.id')
            ->get();
        return $facturas;
    }

    public function imprimir($facturaID)
    {
        Log::info("Iniciando la generación de PDF para la factura: $facturaID");
        $factura = Factura::with('articulos', 'articulos.iva')->find($facturaID);
        Log::info("Factura cargada desde la base de datos");

        if (!$factura) {
            Log::info("La factura $facturaID no se encontró");
            session()->flash('error', 'No se encuentra la factura indicada');
            return view('facturas.show');
        }

        $total = 0;
        $base4 = 0;
        $base10 = 0;
        $base21 = 0;
        $por = 0;

        foreach ($factura->articulos as $articulo) {
            $total += $articulo->pivot->cantidad * $articulo->precio;

            $ivaPorcentaje = $articulo->iva->por;
            switch ($ivaPorcentaje) {
                case '21':
                    $base21 += $articulo->pivot->cantidad * $articulo->precio;
                    break;
                case '10':
                    $base10 += $articulo->pivot->cantidad * $articulo->precio;
                    break;
                case '4':
                    $base4 += $articulo->pivot->cantidad * $articulo->precio;
                    break;
            }
        }
        Log::info("Cálculos realizados para la factura");

        $html = view('facturas.show', [
            'factura' => $factura,
            'total' => $total,
            'base4' => $base4,
            'base10' => $base10,
            'base21' => $base21,
            'cuota4' => $base4 * 0.04,
            'cuota10' => $base10 * 0.1,
            'cuota21' => $base21 * 0.21,
        ])->render();
        Log::info("Vista renderizada a HTML");

        try {
            $mpdf = new Mpdf();
            Log::info("Instancia de Mpdf creada");

            Log::info("Escribiendo HTML en Mpdf");
            $mpdf->WriteHTML($html);
            Log::info("HTML escrito en Mpdf");

            Log::info("Generando salida de PDF");
            $mpdf->Output("Factura-{$factura->id}.pdf", 'I');
            Log::info("PDF generado y enviado al navegador");
        } catch (\Exception $e) {
            Log::error("Error al generar el PDF: " . $e->getMessage());
        }
    }
}
