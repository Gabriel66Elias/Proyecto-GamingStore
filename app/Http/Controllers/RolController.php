<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // SoftDelete filtra deleted_at automáticamente
        $roles = Rol::withCount('usuarios')->orderBy('nombre')->get();
        
        // ACTUALIZADO: Apunta a la carpeta adminpanel/roles/
        return view('adminpanel.roles.index', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'      => 'required|string|max:50|unique:roles',
            'descripcion' => 'nullable|string|max:255',
        ]);

        Rol::create($request->only(['nombre', 'descripcion'])); // usa $fillable del Model

        return redirect()->route('roles.index')->with('exito', 'Rol creado.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Buscamos el rol real en la base de datos usando el ID numérico
        $rol = Rol::findOrFail($id);

        if ($rol->usuarios()->exists()) {
            return redirect()->route('roles.index')->with('error', 'No se puede eliminar: hay usuarios con este rol.');
        }

        $rol->delete(); // SoftDelete: setea deleted_at, no borra la fila
        return redirect()->route('roles.index')->with('exito', 'Rol eliminado.');
    }
}