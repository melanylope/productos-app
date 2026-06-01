@extends('layouts.app')
@section('titulo', 'Productos')
@section('contenido')

<div class="page-header fade-up">
    <h1>Productos <span class="count-tag">{{ $productos->count() }} registros</span></h1>
    <a href="{{ route('productos.galeria') }}" class="btn btn-outline btn-sm">Ver galería</a>
</div>

@if($productos->isEmpty())
    <div class="empty-state fade-up">
        <div class="icon">📦</div>
        <p>No hay productos registrados aún.</p>
    </div>
@else
    <div class="table-wrap fade-up fade-up-1">
        <table>
            <thead>
                <tr>
                    <th>#</th><th>Nombre</th><th>Marca</th><th>Precio</th><th>Stock</th><th>Categoría</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $producto)
                <tr>
                    <td><span style="font-family:'Space Mono',monospace;font-size:0.72rem;color:var(--ink3);">#{{ str_pad($producto->id_producto,3,'0',STR_PAD_LEFT) }}</span></td>
                    <td>
                        <a href="{{ route('productos.show', $producto->id_producto) }}"
                           style="color:var(--ink);font-weight:600;transition:color 0.2s;"
                           onmouseover="this.style.color='var(--neon)'" onmouseout="this.style.color='var(--ink)'">
                            {{ $producto->nombre }}
                        </a>
                    </td>
                    <td>{{ $producto->marca }}</td>
                    <td><span style="font-family:'Space Mono',monospace;font-size:0.85rem;">S/. {{ number_format($producto->precio, 2) }}</span></td>
                    <td>
                        @if($producto->stock > 20)     <span class="badge badge-ok">{{ $producto->stock }}</span>
                        @elseif($producto->stock > 5)  <span class="badge badge-warn">{{ $producto->stock }}</span>
                        @elseif($producto->stock > 0)  <span class="badge badge-low">{{ $producto->stock }} ⚠</span>
                        @else                           <span class="badge badge-agotado">0</span>
                        @endif
                    </td>
                    <td><span class="badge badge-cat">{{ $producto->categoria->descripcion ?? 'Sin categoría' }}</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif

@endsection