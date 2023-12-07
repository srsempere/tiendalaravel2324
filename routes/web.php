<?php

use App\Generico\Carrito;
use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\IvaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Articulo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('principal', [
        'articulos' => Articulo::with('iva', 'categoria')->get(),
        'carrito' => Carrito::carrito(),
    ]);
})->name('principal');

Route::get('/principal', function () {
    return view('principal', [
        'articulos' => Articulo::with('iva', 'categoria')->get(),
        'carrito' => Carrito::carrito(),
    ]);
})->name('principal');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::resource('articulos', ArticuloController::class);

Route::resource('categorias', CategoriaController::class)->middleware('auth');

Route::resource('ivas', IvaController::class)->middleware('auth');

Route::get('buscar-articulos', [ArticuloController::class, 'buscar'])->name('buscar_articulos');

Route::get('/carrito/insertar/{id}', [CarritoController::class, 'insertar'])->name('carrito.insertar')->whereNumber('id');

Route::get('/carrito/eliminar/{id}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar')->whereNumber('id');

Route::get('/carrito/vaciar', [CarritoController::class, 'vaciar'])->name('carrito.vaciar');

Route::get('/comprar', function () {
    return view('comprar', [
        'carrito' => Carrito::carrito(),
    ]);
})->middleware('auth')->name('comprar');

Route::post('wishlist/add/{articulo}', [UserController::class, 'addToWishList'])->name('wishlist.add');

Route::get('/listaDeseos', function () {
    if (!Auth::check()) {
        return redirect()->route('login');
    }
    $listaDeseos = Auth::user()->listaDeseos()->get();
    return view('listaDeseos', ['listaDeseos' => $listaDeseos]);
})->name('listaDeseos');


require __DIR__ . '/auth.php';
