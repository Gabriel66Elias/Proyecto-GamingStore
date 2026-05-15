<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'El email o la contraseña son incorrectos.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nombre'   => 'required|string|max:100',
            'email'    => 'required|email|unique:usuarios',
            'password' => 'required|min:8|confirmed',
        ]);

        $rolCliente = Rol::where('nombre', 'cliente')->firstOrFail();

        $usuario = Usuario::create([
            'nombre'  => $request->nombre,
            'email'   => $request->email,
            'password' => $request->password,
            'rol_id'  => $rolCliente->id,
        ]);

        Auth::login($usuario);

        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
