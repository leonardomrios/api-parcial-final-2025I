<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Ejecutar seeders en orden correcto:
        // 1. Usuarios (independientes)
        $this->call(UserSeeder::class);
        
        // 2. Categorías (independientes)
        $this->call(CategorySeeder::class);
        
        // 3. Computadoras (dependen de categorías)
        $this->call(ComputerSeeder::class);
    }
}
