@extends('layouts.app')

@section('content')
<style>
    .card {
        background: rgba(255, 255, 255, 0.9);
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    .custom-header {
        background: linear-gradient(135deg, #28a745, #218838);
        color: white;
        font-weight: bold;
        text-align: center;
        padding: 15px;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="custom-header">
                    <i class="bi bi-envelope-check"></i> {{ __('Verifica Tu Correo Electrónico') }}
                </div>
                <div class="card-body p-5 text-center">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Se ha enviado un nuevo enlace de verificación a tu correo electrónico.') }}
                        </div>
                    @endif

                    <p class="text-secondary fw-bold">{{ __('Antes de continuar, revisa tu correo electrónico para obtener el enlace de verificación.') }}</p>
                    <p class="text-secondary">{{ __('Si no recibiste el correo, puedes solicitar otro haciendo clic en el botón de abajo.') }}</p>

                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-success btn-lg fw-bold shadow-sm">{{ __('Solicitar otro correo') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
