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
/* --------------------------------------------------------------------------
   RUTAS ESTÁTICAS (GET)
   Se usa el método GET porque el usuario solo está "pidiendo" ver una página.
   Como no hay lógica compleja de base de datos en estas páginas, usamos 
   funciones anónimas (closures) que directamente retornan la vista Blade.
   -------------------------------------------------------------------------- */

Route::get('/', function () {
    $productosDestacados = \App\Models\Producto::inRandomOrder()->limit(4)->get();
    return view('principal', compact('productosDestacados'));
});

Route::get('/quienes-somos', function () {
    return view('quienes-somos');
});

Route::get('/comercializacion', function () {
    return view('comercializacion'); // Pantalla de Checkout
});

Route::get('/terminos', function () {
    return view('terminos');
});

Route::get('/contacto', function () {
    return view('contacto'); // Pantalla con el formulario vacío
});

Route::get('/confirmacion-pedido', function () {
    return view('confirmacionpedido'); // Pantalla de éxito tras el checkout
});


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
Route::get('/consulta/{id}', [ProductoController::class, 'show']);

Route::resource('usuarios', UsuarioController::class);

Route::resource('roles', RolController::class);

/* --------------------------------------------------------------------------
   RUTAS DE AUTENTICACIÓN
   -------------------------------------------------------------------------- */
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/mi-perfil', [AuthController::class, 'perfil'])->middleware('auth')->name('perfil');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard',               [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/stock',                   [AdminController::class, 'stock'])->name('stock');
    Route::get('/consultas',                    [AdminController::class, 'consultas'])->name('consultas');
    Route::patch('/consultas/{id}/leida',       [AdminController::class, 'marcarLeida'])->name('consultas.leida');
    Route::delete('/consultas/{id}',            [AdminController::class, 'destroyConsulta'])->name('consultas.destroy');
    Route::get('/pedidos',                      [AdminController::class, 'pedidos'])->name('pedidos');

    // CRUD de productos
    Route::get('/productos',               [AdminController::class, 'productos'])->name('productos');
    Route::get('/productos/crear',         [AdminController::class, 'create'])->name('productos.crear');
    Route::post('/productos',              [AdminController::class, 'store'])->name('productos.store');
    Route::get('/productos/{id}/editar',   [AdminController::class, 'edit'])->name('productos.editar');
    Route::put('/productos/{id}',          [AdminController::class, 'update'])->name('productos.update');
    Route::delete('/productos/{id}',       [AdminController::class, 'destroy'])->name('productos.destroy');
});