@extends('layouts.app')
@section('titulo', 'Inicio')
@section('contenido')

@auth
<div class="alert alert-success fade-up">
    Bienvenido de vuelta, <strong>{{ Auth::user()->name }}</strong>.
</div>
@endauth

<div class="page-header fade-up">
    <h1>Dashboard</h1>
    <div style="display:flex;gap:0.75rem;">
        <a href="{{ route('productos.galeria') }}" class="btn btn-success">Ver Galería</a>
        <a href="{{ route('productos.index') }}" class="btn btn-outline">Ver Productos</a>
    </div>
</div>

<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:1.25rem;margin-bottom:2.5rem;">
    <div class="stat-card fade-up fade-up-1">
        <div class="stat-glow" style="background:var(--amber);"></div>
        <div class="stat-value" style="color:var(--amber);">{{ $totalCategorias }}</div>
        <div class="stat-label">Categorías</div>
    </div>
    <div class="stat-card fade-up fade-up-2">
        <div class="stat-glow" style="background:var(--neon);"></div>
        <div class="stat-value" style="color:var(--neon);">{{ $totalProductos }}</div>
        <div class="stat-label">Productos</div>
    </div>
</div>

<div class="card fade-up fade-up-3">
    <h2 style="font-family:'Syne',sans-serif;font-weight:700;font-size:1.15rem;letter-spacing:-0.02em;margin-bottom:1.25rem;">Acceso Rápido</h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:0.75rem;">
        <a href="{{ route('productos.galeria') }}" style="display:flex;align-items:center;gap:0.75rem;padding:1rem 1.25rem;background:var(--glass);border:1px solid var(--glass-bd);border-radius:12px;color:var(--ink2);font-size:0.85rem;font-weight:500;transition:all 0.2s;"
           onmouseover="this.style.borderColor='rgba(127,255,110,0.25)';this.style.color='var(--ink)';"
           onmouseout="this.style.borderColor='var(--glass-bd)';this.style.color='var(--ink2)';">
            <span>🖼</span> Galería de Productos
        </a>
        <a href="{{ route('categorias.index') }}" style="display:flex;align-items:center;gap:0.75rem;padding:1rem 1.25rem;background:var(--glass);border:1px solid var(--glass-bd);border-radius:12px;color:var(--ink2);font-size:0.85rem;font-weight:500;transition:all 0.2s;"
           onmouseover="this.style.borderColor='rgba(255,179,71,0.25)';this.style.color='var(--ink)';"
           onmouseout="this.style.borderColor='var(--glass-bd)';this.style.color='var(--ink2)';">
            <span>📂</span> Ver Categorías
        </a>
        <a href="{{ route('carrito.index') }}" style="display:flex;align-items:center;gap:0.75rem;padding:1rem 1.25rem;background:var(--glass);border:1px solid var(--glass-bd);border-radius:12px;color:var(--ink2);font-size:0.85rem;font-weight:500;transition:all 0.2s;"
           onmouseover="this.style.borderColor='rgba(168,216,255,0.25)';this.style.color='var(--ink)';"
           onmouseout="this.style.borderColor='var(--glass-bd)';this.style.color='var(--ink2)';">
            <span>🛒</span> Mi Carrito
        </a>
    </div>
</div>

@endsection