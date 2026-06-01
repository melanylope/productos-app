@extends('layouts.app')
@section('titulo', 'Mi Carrito')
@section('contenido')

<div class="page-header fade-up">
    <h1>Mi Carrito</h1>
    <a href="{{ route('productos.galeria') }}" class="btn btn-outline btn-sm">← Seguir comprando</a>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:1px;background:var(--border);border:1px solid var(--border);border-radius:14px;overflow:hidden;margin-bottom:2rem;" class="fade-up fade-up-1">
    <div style="background:var(--glass);padding:1.1rem 1.5rem;backdrop-filter:blur(8px);">
        <div style="font-family:'Space Mono',monospace;font-size:0.62rem;letter-spacing:0.1em;text-transform:uppercase;color:var(--ink3);margin-bottom:0.35rem;">Comprador</div>
        <div style="font-weight:700;color:var(--ink);">{{ Auth::user()->name }}</div>
    </div>
    <div style="background:var(--glass);padding:1.1rem 1.5rem;backdrop-filter:blur(8px);">
        <div style="font-family:'Space Mono',monospace;font-size:0.62rem;letter-spacing:0.1em;text-transform:uppercase;color:var(--ink3);margin-bottom:0.35rem;">Fecha del pedido</div>
        <div style="font-family:'Space Mono',monospace;font-size:0.85rem;color:var(--ink2);">{{ now()->format('d/m/Y — H:i') }}</div>
    </div>
</div>

@if(empty($productos))
    <div class="empty-state fade-up">
        <div class="icon">🛍</div>
        <p>Tu carrito está vacío.</p>
        <a href="{{ route('productos.galeria') }}" class="btn btn-success">Explorar productos</a>
    </div>
@else
    <div class="table-wrap fade-up fade-up-2" style="margin-bottom:1.5rem;">
        <table>
            <thead>
                <tr>
                    <th style="width:64px;padding-left:1.5rem;">Img</th>
                    <th>Producto</th><th>Precio</th><th>Cantidad</th><th>Subtotal</th><th style="width:80px;"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $item)
                <tr>
                    <td style="padding-left:1.5rem;">
                        @if($item['producto']->foto && file_exists(public_path('img/productos/' . $item['producto']->foto)))
                            <img src="{{ asset('img/productos/' . $item['producto']->foto) }}" style="width:48px;height:48px;object-fit:cover;border-radius:8px;border:1px solid var(--border);filter:brightness(0.9);">
                        @else
                            <div style="width:48px;height:48px;background:var(--glass);border-radius:8px;border:1px solid var(--border);"></div>
                        @endif
                    </td>
                    <td>
                        <strong>{{ $item['producto']->nombre }}</strong><br>
                        <span style="color:var(--ink3);font-size:0.78rem;">{{ $item['producto']->marca }}</span>
                    </td>
                    <td><span style="font-family:'Space Mono',monospace;font-size:0.82rem;">S/. {{ number_format($item['producto']->precio, 2) }}</span></td>
                    <td>
                        <div style="display:flex;align-items:center;gap:0.5rem;">
                            <form action="{{ route('carrito.quitar', $item['producto']->id_producto) }}" method="POST">
                                @csrf
                                <button class="btn btn-outline btn-sm" style="width:30px;height:30px;padding:0;justify-content:center;font-size:1.1rem;">−</button>
                            </form>
                            <span style="font-family:'Space Mono',monospace;font-weight:700;min-width:20px;text-align:center;">{{ $item['cantidad'] }}</span>
                            <form action="{{ route('carrito.agregar', $item['producto']->id_producto) }}" method="POST">
                                @csrf
                                <button class="btn btn-success btn-sm" style="width:30px;height:30px;padding:0;justify-content:center;font-size:1.1rem;">+</button>
                            </form>
                        </div>
                    </td>
                    <td><span style="font-family:'Space Mono',monospace;font-weight:700;color:var(--ink);">S/. {{ number_format($item['subtotal'], 2) }}</span></td>
                    <td>
                        <form action="{{ route('carrito.quitar', $item['producto']->id_producto) }}" method="POST">
                            @csrf
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Quitar este producto?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div style="display:flex;justify-content:flex-end;align-items:center;gap:1rem;flex-wrap:wrap;" class="fade-up fade-up-3">
        <form action="{{ route('carrito.vaciar') }}" method="POST">
            @csrf
            <button class="btn btn-outline" onclick="return confirm('¿Vaciar el carrito?')">Vaciar carrito</button>
        </form>
        <div style="background:var(--glass);border:1px solid var(--glass-bd);border-radius:14px;padding:1rem 1.75rem;text-align:right;backdrop-filter:blur(12px);">
            <div style="font-family:'Space Mono',monospace;font-size:0.62rem;letter-spacing:0.1em;text-transform:uppercase;color:var(--ink3);margin-bottom:0.25rem;">Total</div>
            <div style="font-family:'Space Mono',monospace;font-size:1.75rem;font-weight:700;color:var(--neon);">S/. {{ number_format($total, 2) }}</div>
        </div>
        <button class="btn btn-primary" style="padding:0.85rem 2.25rem;" onclick="alert('Función de pago no implementada aún.')">Confirmar pedido →</button>
    </div>
@endif

@endsection