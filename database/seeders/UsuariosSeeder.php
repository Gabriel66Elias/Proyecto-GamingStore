<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use App\Models\Rol;

class UsuariosSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RolesSeeder::class, // Este lo dejamos porque tu formulario necesita los roles
            // UsuariosSeeder::class, <--- COMENTALO O BORRALO
        ]);
    }
}
