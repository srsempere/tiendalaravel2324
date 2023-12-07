<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Generico\Carrito;
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
        return view('facturas.index');
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
}
