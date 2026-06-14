<?php

namespace App\Http\Controllers;

// Importamos la clase Request de Laravel, que contiene toda la información 
// que viaja desde el navegador del usuario hacia nuestro servidor.
use App\Models\Consulta;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    public function procesar(Request $request)
    {
        $data = $request->validate([
            'nombre'  => 'required|string|max:100',
            'email'   => 'required|email|max:150',
            'mensaje' => 'required|string',
        ]);

        Consulta::create($data);

        // ACTUALIZADO: Apunta a la carpeta paginas/
        return view('paginas.exito', [
            'nombre' => $data['nombre'],
            'email'  => $data['email'],
        ]);
    }
}