<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\HomeController;
use App\Models\Investment;

Route::middleware('auth')->group(function () {
    Route::resource('investments', InvestmentController::class);
});

Auth::routes();



Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/auth/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/investments/index', [HomeController::class, 'index'])->name('investments.index');
