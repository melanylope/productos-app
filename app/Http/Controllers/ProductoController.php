<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Carrito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with('categoria')->get();
        return view('productos.index', compact('productos'));
    }

    public function show($id)
    {
        $producto = Producto::with('categoria')->findOrFail($id);

        // Descuentar lo que ya tiene en el carrito
        if (Auth::check()) {
            $enCarrito = Carrito::where('user_id', Auth::id())
                ->where('producto_id', $id)
                ->value('cantidad') ?? 0;
            $producto->stock = max(0, $producto->stock - $enCarrito);
        }

        return view('productos.show', compact('producto'));
    }

    public function galeria(Request $request)
    {
        $categorias = Categoria::all();
        $query = Producto::with('categoria');

        if ($request->filled('categoria')) {
            $query->where('id_categoria', $request->categoria);
        }

        if ($request->filled('buscar')) {
            $query->where('nombre', 'like', '%' . $request->buscar . '%');
        }

        $productos = $query->get();

        // Descuentar stock según lo que ya tiene cada producto en el carrito
        if (Auth::check()) {
            $carritoItems = Carrito::where('user_id', Auth::id())
                ->pluck('cantidad', 'producto_id');

            foreach ($productos as $producto) {
                $enCarrito = $carritoItems->get($producto->id_producto, 0);
                $producto->stock = max(0, $producto->stock - $enCarrito);
            }
        }

        $categoriaSeleccionada = $request->categoria;
        $buscar = $request->buscar;

        return view('productos.galeria', compact('productos', 'categorias', 'categoriaSeleccionada', 'buscar'));
    }
}