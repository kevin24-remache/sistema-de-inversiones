<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\HomeController;
use App\Models\Investment;

// Rutas de autenticación
Auth::routes(['register' => true]);

// Redirección después del login/registro
Route::redirect('/home', '/investments')->name('home');

// Rutas públicas
Route::get('/', function() {
    return redirect()->route('login');
});

// Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {
    // Rutas de inversiones
    Route::resource('investments', InvestmentController::class);

    // Página principal para usuarios autenticados
    Route::get('/investments', [InvestmentController::class, 'index'])->name('investments.index');
});

// Ruta de login
Route::get('/auth/login', function () {
    return view('auth.login');
})->name('login');
