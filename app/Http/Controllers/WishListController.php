<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    public function show()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $listaDeseos = Auth::user()->listaDeseos()->get();
        return view('listaDeseos', ['listaDeseos' => $listaDeseos]);
    }

    public function addToWishList($articuloID)
    {
        $user = auth()->user();
        $user->listaDeseos()->syncWithoutDetaching([$articuloID]);

        return back()->with('exito', 'Artículo añadido a la lista de deseos.');
    }
}
