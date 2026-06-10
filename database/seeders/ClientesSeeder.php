<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use App\Models\Rol;

class ClientesSeeder extends Seeder
{
    public function run(): void
    {
        $rolCliente = Rol::where('nombre', 'cliente')->first();

        $clientes = [
            ['nombre' => 'Lucas García',    'email' => 'lucas.garcia@test.com'],
            ['nombre' => 'Valentina López', 'email' => 'valentina.lopez@test.com'],
            ['nombre' => 'Mateo Fernández', 'email' => 'mateo.fernandez@test.com'],
        ];

        foreach ($clientes as $c) {
            Usuario::firstOrCreate(
                ['email' => $c['email']],
                [
                    'nombre'   => $c['nombre'],
                    'password' => '12345678',
                    'rol_id'   => $rolCliente->id,
                ]
            );
        }
    }
}
