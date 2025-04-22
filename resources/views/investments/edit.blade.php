@extends('layouts.app')

@section('content')
<div class="dashboard-container d-flex">
    <!-- Sidebar -->
    <div class="sidebar bg-dark text-white">
        <div class="logo-container p-3">
            <h4><i class="fas fa-cube me-2"></i> Sistema de Inversiones</h4>
        </div>
        <ul class="nav flex-column sidebar-nav">
            <li class="nav-item nav-category">
                <span>MENU</span>
            </li>

            <li class="nav-item active">
                <a class="nav-link d-flex align-items-center" href="{{ route('investments.index') }}">
                    <i class="fas fa-chart-line me-2"></i>
                    <span>Inversiones</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center" href="#">
                    <i class="fas fa-list me-2"></i>
                    <span>Categorías</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center" href="#">
                    <i class="fas fa-box me-2"></i>
                    <span>Inventario</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center" href="#">
                    <i class="fas fa-shopping-cart me-2"></i>
                    <span>Órdenes</span>
                </a>
            </li>
            <li class="nav-item nav-category mt-3">
                <span>CONFIGURACIÓN</span>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center" href="#">
                    <i class="fas fa-cog me-2"></i>
                    <span>Ajustes</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center" href="#">
                    <i class="fas fa-user me-2"></i>
                    <span>Perfil</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content flex-grow-1">
        <!-- Top Navigation -->
        <div class="top-nav d-flex justify-content-between align-items-center p-3">
            <h4 class="mb-0">Editar Inversión</h4>
            <div class="d-flex align-items-center">
                <div class="theme-switcher me-3" id="theme-switcher" role="button">
                    <i class="fas fa-moon"></i>
                </div>
                <div class="notification me-3 position-relative">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge">2</span>
                </div>
                <div class="settings me-3">
                    <i class="fas fa-cog"></i>
                </div>
                <div class="dropdown">
                    <div class="user-profile dropdown-toggle" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://via.placeholder.com/40" alt="User" class="rounded-circle">
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Mi Perfil</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Configuración</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt me-2"></i>Cerrar Sesión</button>
                            </form>
                        </li>
                    </ul>
                </div>
                <div class="search-bar ms-3">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control bg-light border-0" placeholder="Buscar...">
                    </div>
                </div>
            </div>
        </div>

        <!-- Alert para errores de validación -->
        @if ($errors->any())
            <div class="alert alert-danger m-3">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Dashboard Content -->
        <div class="dashboard-content p-3">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="card-title mb-0">Modificar Detalles de la Inversión</h5>
                                <a href="{{ route('investments.index') }}" class="btn btn-outline-secondary btn-sm">
                                    <i class="fas fa-arrow-left me-1"></i> Volver
                                </a>
                            </div>

                            <form action="{{ route('investments.update', $investment->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="name" class="form-label">Nombre de la Inversión</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           id="name" name="name" value="{{ old('name', $investment->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="amount" class="form-label">Monto ($)</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror"
                                               id="amount" name="amount" value="{{ old('amount', $investment->amount) }}" required>
                                        @error('amount')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="date" class="form-label">Fecha de Inversión</label>
                                    <input type="date" class="form-control @error('date') is-invalid @enderror"
                                           id="date" name="date" value="{{ old('date', $investment->date) }}" required>
                                    @error('date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="file" class="form-label">Documento (Opcional)</label>
                                    <input type="file" class="form-control @error('file') is-invalid @enderror"
                                           id="file" name="file">
                                    <div class="form-text">Formatos permitidos: JPG, PNG, PDF (máx. 2MB)</div>

                                    @if ($investment->file_path)
                                    <div class="mt-2">
                                        <span class="badge bg-info">
                                            <i class="fas fa-file me-1"></i> Documento actual
                                        </span>
                                        <a href="{{ Storage::url($investment->file_path) }}" target="_blank" class="ms-2">
                                            Ver documento
                                        </a>
                                    </div>
                                    @endif

                                    @error('file')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                    <a href="{{ route('investments.index') }}" class="btn btn-light me-md-2">Cancelar</a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Guardar Cambios
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Theme switcher functionality
        const themeSwitcher = document.getElementById('theme-switcher');
        const body = document.body;

        // Check if dark mode is stored in localStorage
        const isDarkMode = localStorage.getItem('darkMode') === 'true';

        // Set initial theme based on localStorage
        if (isDarkMode) {
            enableDarkMode();
        } else {
            disableDarkMode();
        }

        // Theme switcher click event
        themeSwitcher.addEventListener('click', function() {
            if (body.classList.contains('dark-mode')) {
                disableDarkMode();
                localStorage.setItem('darkMode', 'false');
            } else {
                enableDarkMode();
                localStorage.setItem('darkMode', 'true');
            }
        });

        function enableDarkMode() {
            body.classList.add('dark-mode');
            themeSwitcher.innerHTML = '<i class="fas fa-sun"></i>';

            // Change specific elements for dark mode
            document.querySelectorAll('.card, .bg-light, .input-group-text, .form-control, .form-select').forEach(el => {
                el.classList.add('dark-element');
            });
        }

        function disableDarkMode() {
            body.classList.remove('dark-mode');
            themeSwitcher.innerHTML = '<i class="fas fa-moon"></i>';

            // Revert specific elements
            document.querySelectorAll('.card, .bg-light, .input-group-text, .form-control, .form-select').forEach(el => {
                el.classList.remove('dark-element');
            });
        }
    });
</script>
@endsection

@section('styles')
<style>
    /* Estilos para el modo oscuro */
    body.dark-mode {
        background-color: #1a1a1a;
        color: #f5f5f5;
    }

    body.dark-mode .main-content {
        background-color: #1a1a1a;
    }

    body.dark-mode .top-nav {
        background-color: #2a2a2a;
        color: #f5f5f5;
    }

    body.dark-mode .dark-element {
        background-color: #2a2a2a !important;
        color: #f5f5f5 !important;
        border-color: #3a3a3a !important;
    }

    body.dark-mode .text-muted {
        color: #aaa !important;
    }

    /* Estilos adicionales */
    .theme-switcher {
        cursor: pointer;
    }

    .user-profile {
        cursor: pointer;
    }

    /* Animación para el cambio de tema */
    body {
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .card, .bg-light, .input-group-text, .form-control, .form-select {
        transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
    }
</style>
@endsection