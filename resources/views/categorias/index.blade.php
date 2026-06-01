@extends('layouts.app')
@section('titulo', 'Categorías')
@section('contenido')

<div class="page-header fade-up">
    <h1>Categorías <span class="count-tag">{{ $categorias->count() }} registros</span></h1>
</div>

@if($categorias->isEmpty())
    <div class="empty-state fade-up">
        <div class="icon">📂</div>
        <p>No hay categorías registradas aún.</p>
    </div>
@else
    <div class="table-wrap fade-up fade-up-1">
        <table>
            <thead>
                <tr><th>#</th><th>Descripción</th><th>N° Productos</th></tr>
            </thead>
            <tbody>
                @foreach($categorias as $categoria)
                <tr>
                    <td><span style="font-family:'Space Mono',monospace;font-size:0.72rem;color:var(--ink3);">#{{ str_pad($categoria->id_categoria,3,'0',STR_PAD_LEFT) }}</span></td>
                    <td><strong>{{ $categoria->descripcion }}</strong></td>
                    <td>
                        @if($categoria->productos->count() > 0)
                            <span class="badge badge-ok">{{ $categoria->productos->count() }} productos</span>
                        @else
                            <span class="badge badge-agotado">Sin productos</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif

@endsection