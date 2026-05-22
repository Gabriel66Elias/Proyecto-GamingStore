<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use App\Models\Rol;

class UsuariosSeeder extends Seeder
{
    public function run(): void
    {
        $rolAdmin = Rol::where('nombre', 'admin')->first();

        // Creamos SÓLO al admin por código. 
        // Los clientes reales nacerán desde el formulario web.
        Usuario::firstOrCreate(
            ['email' => 'admin@gamingstation.com'],
            [
                'nombre' => 'Admin',
                'password' => '12345678',
                'rol_id' => $rolAdmin->id,
            ]
        );
    }
}