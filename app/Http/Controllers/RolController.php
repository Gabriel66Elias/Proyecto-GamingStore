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
        return view('roles.index', compact('roles'));
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
    public function destroy(Rol $rol)
    {
        if ($rol->usuarios()->exists()) {
            return redirect()->route('roles.index')->with('error', 'No se puede eliminar: hay usuarios con este rol.');
        }

        $rol->delete(); // SoftDelete: setea deleted_at, no borra la fila
        return redirect()->route('roles.index')->with('exito', 'Rol eliminado.');
    }
}
