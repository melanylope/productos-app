<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Desactivar restricciones
        Schema::disableForeignKeyConstraints();

        // Vaciar tablas relacionadas
        DB::table('carritos')->truncate();
        DB::table('users')->truncate();

        // Activar restricciones nuevamente
        Schema::enableForeignKeyConstraints();

        // Crear administrador
        User::create([
            'name'     => 'Administrador',
            'email'    => 'admin@productosapp.com',
            'password' => Hash::make('admin123'),
            'rol'      => 'admin',
        ]);

        // Crear usuario demo
        User::create([
            'name'     => 'Usuario Demo',
            'email'    => 'demo@productosapp.com',
            'password' => Hash::make('demo123'),
            'rol'      => 'user',
        ]);

        $this->command->info('✔ Usuarios creados correctamente');
    }
}