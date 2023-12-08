<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Generico\Carrito;
use App\Models\Iva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
}
