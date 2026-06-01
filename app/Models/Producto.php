<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';
    protected $primaryKey = 'id_producto';

    protected $fillable = [
        'nombre',
        'marca',
        'precio',
        'stock',
        'id_categoria',
        'foto'
    ];

    public function categoria()
    {
        return $this->belongsTo(
            Categoria::class,
            'id_categoria',
            'id_categoria'
        );
    }
}