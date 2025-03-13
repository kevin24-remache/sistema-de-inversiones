@extends('layouts.app')

@section('content')
<style>
    body {
        background: url('{{ asset('images/background.jpg') }}') no-repeat center center fixed;
        background-size: cover;
        height: 100vh;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .overlay {
        position: absolute;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.3);
        backdrop-filter: blur(8px);
    }
    .card {
        background: rgba(255, 255, 255, 0.95);
        border: none;
        border-radius: 15px;
        width: 100%;
        max-width: 800px;
        box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
        padding: 20px;
        z-index: 10;
        animation: fadeIn 0.5s ease-in-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .custom-header {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white;
        font-size: 1.5rem;
        font-weight: bold;
        text-align: center;
        padding: 15px;
        border-radius: 15px 15px 0 0;
    }
    .form-control {
        height: 45px;
        font-size: 1rem;
        border-radius: 10px;
        box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
    }
    .form-control:focus {
        transform: scale(1.02);
        box-shadow: 0 0 10px rgba(37, 99, 235, 0.5);
    }
    .btn-primary {
        background-color: #2563eb;
        border: none;
        border-radius: 10px;
        transition: all 0.3s ease-in-out;
    }
    .btn-primary:hover {
        background-color: #1e40af;
        transform: scale(1.05);
    }
    .btn-outline-secondary {
        border-radius: 10px;
        transition: all 0.3s ease-in-out;
    }
    .btn-outline-secondary:hover {
        background-color: #e5e7eb;
        transform: scale(1.05);
    }
</style>

<div class="overlay"></div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="custom-header">
                    Sistema de Inversiones - Registro
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold text-secondary">Nombre</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold text-secondary">Correo Electrónico</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold text-secondary">Contraseña</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password-confirm" class="form-label fw-bold text-secondary">Confirmar Contraseña</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                        <div class="mb-3">
                            <label for="file" class="form-label fw-bold text-secondary">Subir Archivo</label>
                            <input id="file" type="file" class="form-control @error('file') is-invalid @enderror" name="file" required>
                            @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-grid gap-3">
                            <button type="submit" class="btn btn-primary fw-bold">Registrarse</button>
                            <a href="{{ route('login') }}" class="btn btn-outline-secondary fw-bold">¿Ya tienes una cuenta? Inicia sesión</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
