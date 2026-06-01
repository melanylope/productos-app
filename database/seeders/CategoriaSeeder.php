<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Categoria::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $categorias = [
            ['descripcion' => 'Electrónica'],
            ['descripcion' => 'Ropa y Accesorios'],
            ['descripcion' => 'Alimentos y Bebidas'],
            ['descripcion' => 'Hogar y Jardín'],
            ['descripcion' => 'Deportes'],
        ];

        foreach ($categorias as $cat) {
            Categoria::create($cat);
        }

        $this->command->info('✔ Categorías insertadas: ' . count($categorias));
    }
}