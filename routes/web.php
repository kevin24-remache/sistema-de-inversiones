<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
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

    // Rutas para el panel administrativo
    Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
        // Usa el HomeController para verificar si es admin
        Route::get('/', [HomeController::class, 'adminDashboard'])->name('admin.dashboard');

        // API para el panel administrativo
        Route::prefix('api')->group(function () {
            // Obtener clientes
            Route::get('/clients', [AdminController::class, 'getClients']);

            // Obtener clientes pendientes
            Route::get('/clients/pending', [AdminController::class, 'getPendingClients']);

            // Aprobar cliente
            Route::post('/clients/approve/{id}', [AdminController::class, 'approveClient']);

            // Rechazar cliente
            Route::post('/clients/reject/{id}', [AdminController::class, 'rejectClient']);

            // Actualizar cliente
            Route::put('/clients/{id}', [AdminController::class, 'updateClient']);

            // Eliminar cliente
            Route::delete('/clients/{id}', [AdminController::class, 'deleteClient']);

            // Actualizar tasa de inversión
            Route::post('/settings/investment-rate', [AdminController::class, 'updateInvestmentRate']);
        });
    });
});

// Ruta de login
Route::get('/auth/login', function () {
    return view('auth.login');
})->name('login');
