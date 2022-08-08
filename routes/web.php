<?php

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
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CuestionariosController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\homeController;
Route::get('/',[homeController::class, 'index'])->name('home.index');


Route::resource('cuestionarios',CuestionariosController::class);
Route::get('busquedaCuestionario',[CuestionariosController::class, 'busqueda'])->name('cuestionarios.busqueda');
Route::post('cuestionarios/store',[CuestionariosController::class, 'store'])->name('cuestionarios.store');
Route::post('cuestionarios/update',[CuestionariosController::class, 'update'])->name('cuestionarios.update');
Route::post('cuestionarios/destroy',[CuestionariosController::class, 'destroy'])->name('cuestionarios.destroy');
Route::get('caso_estudio',[CuestionariosController::class, 'caso_estudio'])->name('cuestionarios.caso_estudio');

Route::resource('usuarios',UsuariosController::class);
Route::get('busqueda',[UsuariosController::class, 'busqueda'])->name('usuarios.busqueda');
Route::post('usuarios/store',[UsuariosController::class, 'store'])->name('usuarios.store');
Route::post('usuarios/update',[UsuariosController::class, 'update'])->name('usuarios.update');
Route::post('usuarios/destroy',[UsuariosController::class, 'destroy'])->name('usuarios.destroy');
Route::get('perfil',[UsuariosController::class, 'perfil'])->name('usuarios.perfil');


Route::get('inicio_sesion',[LoginController::class, 'index'])->name('login.index');

Route::post('loginValidator',[LoginController::class, 'loginValidator'])->name('login.loginValidator');

