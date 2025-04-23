<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\CajaController;
use App\Http\Controllers\categoriaController;
use App\Http\Controllers\clienteController;
use App\Http\Controllers\compraController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\InventarioControlller;
use App\Http\Controllers\KardexController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\logoutController;
use App\Http\Controllers\marcaController;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\presentacioneController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\proveedorController;
use App\Http\Controllers\roleController;
use App\Http\Controllers\userController;
use App\Http\Controllers\ventaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [homeController::class, 'index'])->name('panel');

Route::resource('categorias', categoriaController::class)->except('show');
Route::resource('presentaciones', presentacioneController::class)->except('show');
Route::resource('marcas', marcaController::class)->except('show');
Route::resource('productos', ProductoController::class)->except('show', 'destroy');
Route::resource('clientes', clienteController::class)->except('show');
Route::resource('proveedores', proveedorController::class)->except('show');
Route::resource('compras', compraController::class)->except('edit', 'update', 'destroy');
Route::resource('ventas', ventaController::class)->except('edit', 'update', 'destroy');
Route::resource('users', userController::class)->except('show');
Route::resource('roles', roleController::class)->except('show');
Route::resource('profile', profileController::class)->only('index', 'update');
Route::resource('activityLog', ActivityLogController::class)->only('index');
Route::resource('inventario', InventarioControlller::class)->only('index', 'create', 'store');
Route::resource('kardex', KardexController::class)->only('index');
Route::resource('empresa', EmpresaController::class)->only('index', 'update');
Route::resource('empleados', EmpleadoController::class)->except('show');
Route::resource('cajas', CajaController::class)->except('edit', 'update', 'show');
Route::resource('movimientos', MovimientoController::class)->except('show', 'edit', 'update', 'destroy');

Route::get('/login', [loginController::class, 'index'])->name('login.index');
Route::post('/login', [loginController::class, 'login'])->name('login.login');
Route::get('/logout', [logoutController::class, 'logout'])->name('logout');

Route::get('/401', function () {
    return view('pages.401');
});
Route::get('/404', function () {
    return view('pages.404');
});
Route::get('/500', function () {
    return view('pages.500');
});
