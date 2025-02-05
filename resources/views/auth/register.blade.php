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
    .card {
        background: rgba(255, 255, 255, 0.95);
        border: none;
        border-radius: 15px;
        width: 100%; /* Ocupa todo el ancho disponible */
        max-width: 800px; /* Máximo ancho para pantallas grandes */
        box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
    }
    .custom-header {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white;
        font-size: 1.5rem;
        font-weight: bold;
        text-align: center;
        padding: 15px;
    }
    .form-control {
        height: 45px;
        font-size: 1rem;
    }
    button {
        height: 50px;
    }
</style>

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
