<?php

namespace App\Http\Controllers;

use App\Generico\Carrito;
use App\Models\Articulo;
use App\Models\Categoria;
use App\Models\Iva;
use Illuminate\Http\Request;

class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $order = $request->query('order', 'denominacion');
        $direccion = $request->query('direccion', 'asc');
        $articulos = Articulo::with('categoria', 'iva')
            ->orderBy($order, $direccion)
            ->orderBy('denominacion')
            ->paginate(10);
        return view('articulos.index', [
            'articulos' => $articulos,
            'direccion' => $direccion,
            'order' => $order,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articulos.create', [
            'categorias' => Categoria::all(),
            'ivas' => Iva::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $this->validar($request);
        $denominacion = $request->input('denominacion'); //Esto lo hago para arrastrar el nombre y colorearlo luego en verde al insertar el artículo nuevo.
        Articulo::create($validated);
        if ($validated) {
            session()->flash('exito', 'El articulo se ha creado correctamente');
        }
        return redirect()->route('articulos.index',)->with('denominacion', $denominacion);
    }

    /**
     * Display the specified resource.
     */
    public function show(Articulo $articulo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Articulo $articulo)
    {
        return view('articulos.edit', [
            'articulo'  => $articulo,
            'categorias' => Categoria::all(),
            'ivas' => Iva::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Articulo $articulo)
    {
        $validated = $this->validar($request);
        $articulo->update($validated);
        if ($validated) {
            session()->flash('exito', 'El artículo se ha actualizado correctamente');
        }
        return redirect()->route('articulos.index')->with('denominacion', $request->input('denominacion'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Articulo $articulo)
    {
        $articulo->delete();
        session()->flash('exito', 'El artículo se ha borrado correctamente');
        return redirect()->route('articulos.index');
    }

    private function validar(REQUEST $request)
    {
        return $request->validate([
            'denominacion' => 'required|string|max:255',
            'precio' => 'required|numeric|decimal:2|between:-9999.99,9999.99',
            'categoria_id' => 'required|integer|exists:categorias,id',
            'iva_id' => 'required|integer|exists:ivas,id'
        ]);
    }

    public function buscar(Request $request)
    {
        $categoria = $request->input('categoria'); //TODO: Realiza validación

        // Búsqueda en la base de datos

        // Búsqueda en la base de datos
        $articulos = Articulo::whereHas('categoria', function ($query) use ($categoria) {
            $query->where('nombre', 'like', '%' . $categoria . '%');
        })->get();

        return view('principal', [
            'articulos' => $articulos,
            'carrito' => Carrito::carrito(),
        ]);
    }
}
