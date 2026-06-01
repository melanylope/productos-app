<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CarritoController;
use App\Models\Categoria;
use App\Models\Producto;

/*
|--------------------------------------------------------------------------
| RUTAS PÚBLICAS
|--------------------------------------------------------------------------
*/

// Inicio
Route::get('/', function () {
    return view('home', [
        'totalCategorias' => Categoria::count(),
        'totalProductos'  => Producto::count(),
    ]);
})->name('home');

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| RUTAS PROTEGIDAS
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Categorías
    Route::get('/categorias', [CategoriaController::class, 'index'])
        ->name('categorias.index');

    // Productos
    Route::get('/productos', [ProductoController::class, 'index'])
        ->name('productos.index');

    // Galería
    Route::get('/galeria', [ProductoController::class, 'galeria'])
        ->name('productos.galeria');

    // Detalle producto
    Route::get('/productos/{id}', [ProductoController::class, 'show'])
        ->name('productos.show');

    // Carrito
    Route::get('/carrito', [CarritoController::class, 'index'])
        ->name('carrito.index');

    Route::post('/carrito/agregar/{id}', [CarritoController::class, 'agregar'])
        ->name('carrito.agregar');

    Route::post('/carrito/quitar/{id}', [CarritoController::class, 'quitar'])
        ->name('carrito.quitar');

    Route::post('/carrito/vaciar', [CarritoController::class, 'vaciar'])
        ->name('carrito.vaciar');
});