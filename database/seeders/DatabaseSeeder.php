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
            ClientesSeeder::class,
            CategoriasSeeder::class,
            ProductosSeeder::class,
            ConsultasSeeder::class,
            PedidosSeeder::class,
        ]);
    }
}
