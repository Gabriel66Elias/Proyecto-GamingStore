<?php

namespace App\Http\Controllers;

// Importamos la clase Request de Laravel, que contiene toda la información 
// que viaja desde el navegador del usuario hacia nuestro servidor.
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    /**
     * MÉTODO: procesar
     * DESCRIPCIÓN: Se ejecuta cuando la ruta POST '/contacto' es activada.
     * * @param Request $request  (Inyección de dependencias: Laravel automáticamente 
     * nos provee el objeto Request con los datos del form).
     */
    public function procesar(Request $request)
    {
        /* 1. CAPTURA DE DATOS
           Usamos el método ->input() para extraer los valores exactos que el 
           usuario tipeó en las etiquetas <input name="nombre"> y <input name="email"> 
           del HTML. */
        $nombre = $request->input('nombre');
        $email = $request->input('email');

        // (En un proyecto real o etapa posterior, aquí iría la lógica para: 
        // 1. Guardar estos datos en la Base de Datos usando un Modelo.
        // 2. Disparar un Mail() para enviarle un correo automático al cliente).

        /* 2. RESPUESTA AL USUARIO
           En lugar de redirigir a otra URL, retornamos directamente la vista 'exito'
           (resources/views/exito.blade.php).
           
           Al mismo tiempo, le "inyectamos" un array asociativo con los datos 
           capturados, para que Blade pueda imprimirlos en pantalla usando {{ $nombre }} 
           y generar un mensaje de confirmación 100% personalizado. */
        return view('exito', [
            'nombre' => $nombre,
            'email' => $email
        ]);
    }
}