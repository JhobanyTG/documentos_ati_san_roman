<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DocumentosController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Rutas de autenticación
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas de cambio de contraseña
Route::get('/change-password', [AuthController::class, 'showChangePasswordForm'])->name('change-password');
Route::post('/change-password', [AuthController::class, 'changePassword']);

// Rutas de registro (solo para administradores)
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::middleware(['auth'])->group(function () {
    // Otras rutas protegidas por autenticación...

    // Ruta a la vista documentos.index
    Route::get('/documentos', [DocumentosController::class, 'index'])->name('documentos.index');





    // Register Usuarios
    Route::resource('/usuarios',UserController::class)
        ->middleware('auth');
    Route::get('/usuarios/{id}/cambiar-contrasena', [UserController::class, 'cambiarContrasena'])
        ->middleware('auth')
        ->name('usuarios.cambiarContrasena');
    Route::put('/usuarios/{id}/actualizar-contrasena', [UserController::class, 'actualizarContrasena'])
        ->middleware('auth')
        ->name('usuarios.actualizarContrasena');
    Route::get('/register', [UserController::class, 'create'])
        ->middleware('auth')
        ->name('register.create');
    Route::post('/register', [UserController::class, 'store'])
        ->middleware('auth')
        ->name('register.store');
});