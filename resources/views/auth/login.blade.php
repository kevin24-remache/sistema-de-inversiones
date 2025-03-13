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
        animation: fadeIn 1.5s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .title {
        font-size: 2.8rem;
        font-weight: bold;
        color: #fff;
        text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.7);
        margin-bottom: 30px;
        animation: slideDown 1s ease-in-out;
    }

    @keyframes slideDown {
        from { transform: translateY(-20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    .card {
        background: rgba(255, 255, 255, 0.95);
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        padding: 30px;
        max-width: 400px;
        width: 100%;
        animation: zoomIn 0.8s ease-in-out;
    }

    @keyframes zoomIn {
        from { transform: scale(0.9); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }

    .custom-header {
        background: linear-gradient(135deg, #007bff, #00c6ff);
        text-align: center;
        color: white;
        padding: 15px 0;
        font-size: 1.5rem;
        font-weight: bold;
        border-radius: 15px 15px 0 0;
        animation: fadeIn 1.2s ease-in-out;
    }

    .form-control {
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
    }

    .btn {
        border-radius: 10px;
        font-size: 1.2rem;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background: #0056b3;
        transform: scale(1.05);
    }

    .btn-warning:hover {
        background: #e0a800;
        transform: scale(1.05);
    }

    .btn-link:hover {
        text-decoration: underline;
    }
</style>

<div class="title animate__animated animate__fadeInDown">
    Sistema de Inversiones
</div>

<div class="card animate__animated animate__zoomIn">
    <div class="custom-header">
        <i class="bi bi-box-arrow-in-right"></i> {{ __('Inicio de Sesión') }}
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
            @CSRF

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