@extends('layouts.app')

@section('content')
<style>
    .card {
        background: rgba(255, 255, 255, 0.9);
    }
    .custom-header {
        background: linear-gradient(135deg, #ff7eb3, #ff758c);
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="card-header text-center text-white custom-header fw-bold fs-4 py-4">
                    <i class="bi bi-person-plus-fill"></i> {{ __('Registro') }}
                </div>
                <div class="card-body p-5">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @CSRF

                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold text-secondary">{{ __('Nombre') }}</label>
                            <input id="name" type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label fw-bold text-secondary">{{ __('Correo Electrónico') }}</label>
                            <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
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

                        <div class="mb-4">
                            <label for="password-confirm" class="form-label fw-bold text-secondary">{{ __('Confirmar Contraseña') }}</label>
                            <input id="password-confirm" type="password" class="form-control form-control-lg" name="password_confirmation" required>
                        </div>

                        <div class="mb-4">
                            <label for="file" class="form-label fw-bold text-secondary">{{ __('Subir Archivo') }}</label>
                            <input id="file" type="file" class="form-control form-control-lg @error('file') is-invalid @enderror" name="file" required>
                            @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg fw-bold shadow-sm">{{ __('Registrarse') }}</button>
                            <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-lg fw-bold">{{ __('¿Ya tienes una cuenta? Inicia sesión') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
