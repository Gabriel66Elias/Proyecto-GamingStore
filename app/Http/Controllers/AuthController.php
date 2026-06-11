<?php

namespace App\Http\Controllers;

use App\Models\Resena;
use App\Models\Rol;
use App\Models\Usuario;
use App\Models\VentaCabecera;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CarritoController;

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

            // Fusionar carrito de invitado (sesión) al carrito de DB del usuario
            CarritoController::fusionarCarritoGuest();

            if (Auth::user()->rol?->nombre === 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            }

            // Si quedó guardada una URL de admin de un intento anterior (de
            // otra cuenta), la descartamos para no enviar a un cliente ahí.
            $intended = $request->session()->get('url.intended');
            if ($intended && str_starts_with($intended, url('/admin'))) {
                $request->session()->forget('url.intended');
            }

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

        // Fusionar carrito de invitado al nuevo carrito del usuario registrado
        CarritoController::fusionarCarritoGuest();

        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function perfil()
    {
        $usuario = Auth::user();

        $pedidos = VentaCabecera::where('user_id', $usuario->id)
            ->whereNotIn('estado', ['carrito'])
            ->with('detalles.producto')
            ->latest('fecha_venta')
            ->get();

        $favoritos = $usuario->favoritos()->with('categoria')->latest('favoritos.created_at')->get();

        $resenas = Resena::where('usuario_id', $usuario->id)
            ->get()
            ->keyBy(fn ($r) => $r->venta_id . '-' . $r->producto_id);

        return view('perfilusuario', compact('usuario', 'pedidos', 'favoritos', 'resenas'));
    }

    public function descargarFactura($id)
    {
        $pedido = VentaCabecera::where('user_id', Auth::id())
            ->whereNotIn('estado', ['carrito'])
            ->with('detalles.producto')
            ->findOrFail($id);

        $pdf = Pdf::loadView('factura-pdf', compact('pedido'))->setPaper('a4', 'portrait');

        return $pdf->download('Factura-' . ($pedido->numero_pedido ?? $pedido->id) . '.pdf');
    }
}
