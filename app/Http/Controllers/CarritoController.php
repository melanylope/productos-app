<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Carrito;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    public function index()
    {
        $items = Carrito::where('user_id', Auth::id())
            ->with('producto')
            ->get();

        $productos = [];
        $total = 0;

        foreach ($items as $item) {
            $subtotal = $item->producto->precio * $item->cantidad;
            $total += $subtotal;

            $productos[] = [
                'producto' => $item->producto,
                'cantidad' => $item->cantidad,
                'subtotal' => $subtotal,
            ];
        }

        return view('carrito.index', compact('productos', 'total'));
    }

    public function agregar($id)
    {
        $producto = Producto::findOrFail($id);

        if ($producto->stock == 0) {
            return back()->with('error', '¡Stock agotado! No hay unidades disponibles de "' . $producto->nombre . '".');
        }

        $item = Carrito::where('user_id', Auth::id())
            ->where('producto_id', $id)
            ->first();

        if ($item) {
            if ($item->cantidad < $producto->stock) {
                $item->cantidad++;
                $item->save();
                return back()->with('success', 'Producto agregado al carrito.');
            } else {
                return back()->with('error', '¡Stock agotado! Ya tienes todas las unidades disponibles de "' . $producto->nombre . '" en tu carrito.');
            }
        } else {
            Carrito::create([
                'user_id'    => Auth::id(),
                'producto_id' => $id,
                'cantidad'   => 1
            ]);
            return back()->with('success', 'Producto agregado al carrito.');
        }
    }

    public function quitar($id)
    {
        $item = Carrito::where('user_id', Auth::id())
            ->where('producto_id', $id)
            ->first();

        if ($item) {
            if ($item->cantidad > 1) {
                $item->cantidad--;
                $item->save();
            } else {
                $item->delete();
            }
        }

        return back()->with('info', 'Producto actualizado.');
    }

    public function vaciar()
    {
        Carrito::where('user_id', Auth::id())->delete();
        return back()->with('info', 'Carrito vaciado.');
    }
}