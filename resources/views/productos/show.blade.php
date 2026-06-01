@extends('layouts.app')
@section('titulo', $producto->nombre)
@section('contenido')

<a href="{{ route('productos.galeria') }}" class="btn btn-outline btn-sm fade-up" style="margin-bottom:2rem;display:inline-flex;">← Volver a la galería</a>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:2rem;align-items:start;" class="fade-up fade-up-1">

    <div>
        @if($producto->foto && file_exists(public_path('img/productos/' . $producto->foto)))
            <div style="border-radius:20px;overflow:hidden;border:1px solid var(--glass-bd);background:var(--glass);">
                <img src="{{ asset('img/productos/' . $producto->foto) }}" alt="{{ $producto->nombre }}" style="width:100%;display:block;filter:brightness(0.95) saturate(1.1);">
            </div>
        @else
            <div style="height:360px;border-radius:20px;border:1px solid var(--glass-bd);background:repeating-linear-gradient(45deg,rgba(255,255,255,0.01) 0px,rgba(255,255,255,0.01) 1px,transparent 1px,transparent 20px);display:flex;align-items:center;justify-content:center;font-family:'Space Mono',monospace;font-size:0.7rem;letter-spacing:0.1em;color:var(--ink3);">NO IMAGE</div>
        @endif
    </div>

    <div style="display:flex;flex-direction:column;gap:1.5rem;">
        <div>
            <span class="cat-label" style="display:block;margin-bottom:0.5rem;">{{ $producto->categoria->descripcion ?? 'Sin categoría' }}</span>
            <h1 style="font-family:'Syne',sans-serif;font-weight:800;font-size:2.2rem;letter-spacing:-0.03em;line-height:1.1;margin-bottom:0.5rem;">{{ $producto->nombre }}</h1>
            <p style="color:var(--ink3);font-size:0.88rem;">{{ $producto->marca }}</p>
        </div>

        <div style="background:var(--glass);border:1px solid var(--glass-bd);border-radius:16px;overflow:hidden;">
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1px;background:var(--border);">
                <div style="background:var(--surface);padding:1.25rem 1.5rem;">
                    <div style="font-family:'Space Mono',monospace;font-size:0.62rem;letter-spacing:0.1em;text-transform:uppercase;color:var(--ink3);margin-bottom:0.4rem;">Precio</div>
                    <div style="font-family:'Space Mono',monospace;font-size:1.6rem;font-weight:700;color:var(--neon);">S/. {{ number_format($producto->precio, 2) }}</div>
                </div>
                <div style="background:var(--surface);padding:1.25rem 1.5rem;">
                    <div style="font-family:'Space Mono',monospace;font-size:0.62rem;letter-spacing:0.1em;text-transform:uppercase;color:var(--ink3);margin-bottom:0.4rem;">Stock</div>
                    <div style="padding-top:0.25rem;">
                        @if($producto->stock == 0)          <span class="badge badge-agotado">Agotado</span>
                        @elseif($producto->stock > 20)      <span class="badge badge-ok">{{ $producto->stock }} disponibles</span>
                        @elseif($producto->stock > 5)       <span class="badge badge-warn">{{ $producto->stock }} disponibles</span>
                        @else                               <span class="badge badge-low">{{ $producto->stock }} disponibles</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('carrito.agregar', $producto->id_producto) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success {{ $producto->stock == 0 ? 'btn-disabled' : '' }}" style="width:100%;justify-content:center;padding:0.85rem;" {{ $producto->stock == 0 ? 'disabled' : '' }}>
                🛒 Agregar al carrito
            </button>
        </form>

        <a href="{{ route('productos.galeria') }}" class="btn btn-outline" style="justify-content:center;">← Seguir explorando</a>
    </div>
</div>

@endsection