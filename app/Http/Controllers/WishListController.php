<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    public function addToWishList($artiuloID)
    {
        if (!Auth   ::check()) {
            return redirect()->route('login');
        }
        $listaDeseos = Auth::user()->listaDeseos()->get();
        return view('listaDeseos', ['listaDeseos' => $listaDeseos]);
    }
}
