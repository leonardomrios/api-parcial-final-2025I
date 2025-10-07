<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear usuario de prueba para testing (evitar duplicados)
        \App\Models\User::firstOrCreate(
            ['email' => 'leo@correo.com'],
            [
                'name' => 'Leonardo',
                'password' => \Illuminate\Support\Facades\Hash::make('123456'),
            ]
        );

        // Crear usuario adicional para pruebas (evitar duplicados)
        \App\Models\User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
            ]
        );

        // Crear usuarios adicionales usando factory solo si no hay muchos usuarios
        if (\App\Models\User::count() < 10) {
            \App\Models\User::factory(5)->create();
        }
    }
}
