@extends('layouts.app')

@section('content')
<style>
    body {
        background: url('{{ asset('images/background.jpg') }}') no-repeat center center fixed;
        background-size: cover;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }

    .title {
        font-size: 2.5rem;
        font-weight: bold;
        color: #fff;
        text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
        margin-bottom: 30px;
    }

    .card {
        background: rgba(255, 255, 255, 0.95);
        border: none;
        border-radius: 15px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        padding: 30px;
        max-width: 400px;
        width: 100%;
    }

    .custom-header {
        background: linear-gradient(135deg, #007bff, #00c6ff);
        text-align: center;
        color: white;
        padding: 15px 0;
        font-size: 1.5rem;
        font-weight: bold;
        border-radius: 15px 15px 0 0;
    }

    .form-control {
        border-radius: 10px;
    }

    .btn {
        border-radius: 10px;
        font-size: 1.2rem;
    }
</style>

<div class="title">
    Sistema de Inversiones
</div>

<div class="card">
    <div class="custom-header">
        <i class="bi bi-box-arrow-in-right"></i> {{ __('Inicio de Sesión') }}
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
            @csrf

            <div class="mb-4">
                <label for="email" class="form-label fw-bold text-secondary">{{ __('Correo Electrónico') }}</label>
                <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="form-label fw-bold text-secondary">{{ __('Contraseña') }}</label>
                <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-lg fw-bold shadow-sm">{{ __('Ingresar') }}</button>
                @if (Route::has('password.request'))
                    <a class="btn btn-link text-decoration-none" href="{{ route('password.request') }}">{{ __('¿Olvidaste tu contraseña?') }}</a>
                @endif
                <a href="{{ route('register') }}" class="btn btn-warning btn-lg fw-bold">{{ __('¿No tienes cuenta? Regístrate') }}</a>
            </div>
        </form>
    </div>
</div>
@endsection
