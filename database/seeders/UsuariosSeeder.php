<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use App\Models\Rol;

class UsuariosSeeder extends Seeder
{
    public function run(): void
    {
        $rolAdmin   = Rol::where('nombre', 'admin')->first();
        $rolCliente = Rol::where('nombre', 'cliente')->first();

        $usuarios = [
            [
                'nombre'   => 'Administrador',
                'email'    => 'admin@gamingstore.com',
                'password' => 'admin1234',
                'rol_id'   => $rolAdmin->id,
            ],
            [
                'nombre'   => 'Cliente Demo',
                'email'    => 'cliente@gamingstore.com',
                'password' => 'cliente1234',
                'rol_id'   => $rolCliente->id,
            ],
        ];

        foreach ($usuarios as $datos) {
            // firstOrCreate evita duplicados si se ejecuta más de una vez
            Usuario::firstOrCreate(
                ['email' => $datos['email']],
                $datos
            );
        }
    }
}
