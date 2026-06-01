@extends('layouts.app')
@section('titulo', 'Galería')
@section('contenido')

<div class="page-header fade-up">
    <h1>Galería <span class="count-tag">{{ $productos->count() }} productos</span></h1>
    <a href="{{ route('productos.index') }}" class="btn btn-outline btn-sm">Ver tabla</a>
</div>

<form method="GET" action="{{ route('productos.galeria') }}" id="filtroForm" class="fade-up fade-up-1">
    <div class="toolbar">
        <input type="text" name="buscar" id="buscador" placeholder="Buscar por nombre..." value="{{ $buscar ?? '' }}">
        <select name="categoria" onchange="document.getElementById('filtroForm').submit()">
            <option value="">Todas las categorías</option>
            @foreach($categorias as $cat)
                <option value="{{ $cat->id_categoria }}" {{ isset($categoriaSeleccionada) && $categoriaSeleccionada == $cat->id_categoria ? 'selected' : '' }}>
                    {{ $cat->descripcion }}
                </option>
            @endforeach
        </select>
        @if(!empty($buscar) || !empty($categoriaSeleccionada))
            <a href="{{ route('productos.galeria') }}" class="btn btn-outline btn-sm">✕ Limpiar</a>
        @endif
    </div>
</form>

@if($productos->isEmpty())
    <div class="empty-state fade-up">
        <div class="icon">∅</div>
        <p>No se encontraron productos.</p>
        <a href="{{ route('productos.galeria') }}" class="btn btn-outline">Ver todos</a>
    </div>
@else
    <div class="galeria-grid">
        @foreach($productos as $i => $producto)
        <div class="producto-card fade-up" style="animation-delay: {{ ($i % 8) * 0.06 }}s">
            <div class="img-wrap">
                @if($producto->foto && file_exists(public_path('img/productos/' . $producto->foto)))
                    <img src="{{ asset('img/productos/' . $producto->foto) }}" alt="{{ $producto->nombre }}">
                @else
                    <div class="no-foto">NO IMAGE</div>
                @endif
                <div class="img-overlay"></div>
                @if($producto->stock == 0)
                    <span class="badge badge-agotado badge-float">Agotado</span>
                @endif
            </div>
            <div class="card-body">
                <span class="cat-label">{{ $producto->categoria->descripcion ?? 'Sin categoría' }}</span>
                <h3>{{ $producto->nombre }}</h3>
                <p class="marca">{{ $producto->marca }}</p>
                <div style="margin-top:0.5rem;">
                    @if($producto->stock == 0)
                        <span class="badge badge-agotado">Sin stock</span>
                    @elseif($producto->stock > 20)
                        <span class="badge badge-ok">Stock: {{ $producto->stock }}</span>
                    @elseif($producto->stock > 5)
                        <span class="badge badge-warn">Stock: {{ $producto->stock }}</span>
                    @else
                        <span class="badge badge-low">Bajo: {{ $producto->stock }}</span>
                    @endif
                </div>
                <p class="precio"><span>S/.</span> {{ number_format($producto->precio, 2) }}</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('productos.show', $producto->id_producto) }}" class="btn btn-outline btn-sm">Ver detalle</a>
                <form action="{{ route('carrito.agregar', $producto->id_producto) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success btn-sm {{ $producto->stock == 0 ? 'btn-disabled' : '' }}" {{ $producto->stock == 0 ? 'disabled' : '' }}>
                        + Carrito
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
@endif

@endsection

@push('scripts')
<script>
    const buscador = document.getElementById('buscador');
    let timer;
    buscador.addEventListener('keyup', () => {
        clearTimeout(timer);
        timer = setTimeout(() => document.getElementById('filtroForm').submit(), 450);
    });
</script>
@endpush