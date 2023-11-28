<?php

namespace App\Http\Controllers;

use App\Models\Iva;
use Illuminate\Http\Request;

class IvaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('ivas.index', [
            'ivas' => Iva::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ivas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $this->validar($request);
        Iva::create($validated);
        return redirect()->route('ivas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Iva $iva)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Iva $iva)
    {
        return view('ivas.edit', [
            'iva' => $iva,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Iva $iva)
    {
        $validated = $this->validar($request);
        $iva->update($validated);
        return redirect()->route('ivas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Iva $iva)
    {
        $iva->delete();
        return redirect()->route('ivas.index');
    }

    public function validar(REQUEST $request)
    {
        return $request->validate([
            'tipo' => 'required|string|max:20',
            'por' => 'required|numeric|between:0,100',
        ]);
    }
}
