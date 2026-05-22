<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RolesSeeder::class,
            UsuariosSeeder::class,
            CategoriasSeeder::class,  // debe correr antes que ProductosSeeder
            ProductosSeeder::class,
        ]);
    }
}
