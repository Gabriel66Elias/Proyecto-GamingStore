<?php

// Importación de clases (Namespaces). 
// Le decimos a este archivo dónde encontrar la clase Route y nuestros Controladores.
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\FavoritoController;
use App\Http\Controllers\ResenaController;

/* --------------------------------------------------------------------------
   RUTAS ESTÁTICAS (GET)
   Se usa el método GET porque el usuario solo está "pidiendo" ver una página.
   Como no hay lógica compleja de base de datos en estas páginas, usamos 
   funciones anónimas (closures) que directamente retornan la vista Blade.
   -------------------------------------------------------------------------- */

Route::get('/', function () {
    $productosDestacados = \App\Models\Producto::inRandomOrder()->limit(4)->get();
    $favoritoIds = \Illuminate\Support\Facades\Auth::check()
        ? \Illuminate\Support\Facades\Auth::user()->favoritos()->pluck('productos.id')->toArray()
        : [];
    return view('paginas.principal', compact('productosDestacados', 'favoritoIds'));
});

Route::get('/quienes-somos', function () {
    return view('paginas.quienes-somos');
});

Route::get('/comercializacion', function () {
    return view('tienda.comercializacion');
});

Route::get('/terminos', function () {
    return view('paginas.terminos');
});

Route::get('/contacto', function () {
    return view('paginas.contacto'); // Pantalla con el formulario vacío
});

Route::get('/confirmacion-pedido', function () {
    return view('tienda.confirmacionpedido');
})->name('compra.confirmada');


/* --------------------------------------------------------------------------
   RUTAS DE ACCIÓN (POST)
   Se usa el método POST porque el usuario está "enviando" información confidencial 
   (los datos del formulario de contacto) hacia el servidor.
   -------------------------------------------------------------------------- */

// Cuando el formulario en /contacto hace "submit", viaja hacia aquí.
// En lugar de una función anónima, delegamos el trabajo al ContactoController,
// diciéndole que ejecute su método llamado 'procesar'.
Route::post('/contacto', [ContactoController::class, 'procesar']);


/* --------------------------------------------------------------------------
   RUTAS DINÁMICAS (Manejadas por Controlador)
   Aquí la lógica requiere pedir productos, agruparlos y formatearlos, 
   por eso se delegan a un Controlador especializado (ProductoController).
   -------------------------------------------------------------------------- */

// Ruta para ver el catálogo entero. Delega al método 'index'.
Route::get('/catalogo', [ProductoController::class, 'index']);

// RUTA CON PARÁMETRO DINÁMICO {id}
// El {id} es una variable comodín en la URL (ej: /consulta/5 o /consulta/10).
// Laravel captura automáticamente ese número y se lo inyecta como 
// parámetro al método 'show' del ProductoController.
// NOTA: Se mantiene la vista original en la raíz según requerimiento.
Route::get('/consulta/{id}', [ProductoController::class, 'show']);

/* --------------------------------------------------------------------------
   RUTAS DE AUTENTICACIÓN
   -------------------------------------------------------------------------- */
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/mi-perfil', [AuthController::class, 'perfil'])->middleware('auth')->name('perfil');
Route::get('/mi-perfil/pedidos/{id}/factura', [AuthController::class, 'descargarFactura'])->middleware('auth')->name('pedidos.factura');

// Carrito — agregar/actualizar/eliminar/vaciar funcionan para invitados y usuarios
// Solo confirmar requiere auth (para crear la venta en la DB)
Route::get('/carrito/datos',         [CarritoController::class, 'datos'])->name('carrito.datos');
Route::post('/carrito/agregar',      [CarritoController::class, 'agregar'])->name('carrito.agregar');
Route::post('/carrito/vaciar',       [CarritoController::class, 'vaciar'])->name('carrito.vaciar');
Route::patch('/carrito/{id}',        [CarritoController::class, 'actualizar'])->name('carrito.actualizar');
Route::delete('/carrito/{id}',       [CarritoController::class, 'eliminar'])->name('carrito.eliminar');

Route::middleware('auth')->group(function () {
    Route::post('/carrito/confirmar', [CarritoController::class, 'confirmar'])->name('carrito.confirmar');
    Route::post('/favoritos/{producto}/toggle', [FavoritoController::class, 'toggle'])->name('favoritos.toggle');
    Route::post('/resenas', [ResenaController::class, 'store'])->name('resenas.store');
});

// Gestión de usuarios y roles (solo admin). Rutas resource limitadas a los
// metodos realmente implementados en los controllers.
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::resource('usuarios', UsuarioController::class)->only(['index', 'create', 'store', 'destroy']);
    Route::resource('roles', RolController::class)->only(['index', 'store', 'destroy']);
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard',               [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/stock',                   [AdminController::class, 'stock'])->name('stock');
    Route::get('/consultas',                    [AdminController::class, 'consultas'])->name('consultas');
    Route::patch('/consultas/{id}/leida',       [AdminController::class, 'marcarLeida'])->name('consultas.leida');
    Route::delete('/consultas/{id}',            [AdminController::class, 'destroyConsulta'])->name('consultas.destroy');
    Route::delete('/resenas/{id}',              [AdminController::class, 'destroyResena'])->name('resenas.destroy');
    Route::get('/pedidos',                           [AdminController::class, 'pedidos'])->name('pedidos');
    Route::get('/pedidos/exportar-pdf',              [AdminController::class, 'exportarPedidosPdf'])->name('pedidos.exportar-pdf');
    Route::patch('/pedidos/{id}/estado',             [AdminController::class, 'actualizarEstadoPedido'])->name('pedidos.estado');

    // CRUD de productos
    Route::get('/productos',               [AdminController::class, 'productos'])->name('productos');
    Route::get('/productos/crear',         [AdminController::class, 'create'])->name('productos.crear');
    Route::post('/productos',              [AdminController::class, 'store'])->name('productos.store');
    Route::get('/productos/{id}/editar',   [AdminController::class, 'edit'])->name('productos.editar');
    Route::put('/productos/{id}',          [AdminController::class, 'update'])->name('productos.update');
    Route::delete('/productos/{id}',       [AdminController::class, 'destroy'])->name('productos.destroy');
});