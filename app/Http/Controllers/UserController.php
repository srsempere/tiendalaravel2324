<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class UserController extends Controller
{
    public function addToWishList($articuloId)
    {
        $user = auth()->user();
        $user->listaDeseos()->syncWithoutDetaching([$articuloId]);

        return back()->with('exito', 'Artículo añadido a la lista de deseos.');
    }
}
