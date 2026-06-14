<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Rol;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // with('rol') carga la relación y evita el problema de consultas N+1
        $usuarios = Usuario::with('rol')->orderBy('nombre')->get();
        return view('adminpanel.usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Rol::all(); // necesario para el <select> del formulario
        return view('adminpanel.usuarios.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'   => 'required|string|max:100',
            'email'    => 'required|email|unique:usuarios',
            'password' => 'required|min:8|confirmed', // busca campo password_confirmation
            'rol_id'   => 'required|exists:roles,id',
        ]);

        Usuario::create($request->only(['nombre', 'email', 'password', 'rol_id']));

        return redirect()->route('usuarios.index')->with('exito', 'Usuario registrado.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
{
    // Evita que el usuario autenticado se borre a sí mismo
    if ($usuario->id === auth()->id()) {
        return redirect()->route('usuarios.index')->with('error', 'Acción denegada: No podés dar de baja una cuenta de Administrador');
    }

    $usuario->delete(); // borrado lógico
    return redirect()->route('usuarios.index')->with('exito', 'Usuario dado de baja.');
    }
}
