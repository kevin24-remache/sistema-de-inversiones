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
                    <i class="fas fa-box me-2"></i>
                    <span>Inventario</span>
                </a>
            </li>

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
            <h4 class="mb-0">Mis Inversiones</h4>
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

        <!-- Alert para mensajes de éxito -->
        @if(session('success'))
            <div class="alert alert-success m-3">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
            </div>
        @endif

        <!-- Dashboard Content -->
        <div class="dashboard-content p-3">
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="card-title mb-0">Lista de Inversiones</h5>
                                <a href="{{ route('investments.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Crear Nueva Inversión
                                </a>
                            </div>

                            @if ($investments->isEmpty())
                                <div class="alert alert-info text-center">
                                    <p class="mb-0">Aún no has registrado inversiones.</p>
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Monto</th>
                                                <th>Fecha</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($investments as $investment)
                                                <tr>
                                                    <td>{{ $investment->name }}</td>
                                                    <td>${{ number_format($investment->amount, 2) }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($investment->date)->format('d M Y') }}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href="{{ route('investments.edit', $investment->id) }}" class="btn btn-sm btn-warning me-1">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <form action="{{ route('investments.destroy', $investment->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta inversión?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Resumen de inversiones -->
                <div class="col-md-6 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h6 class="text-muted mb-3">Total Invertido</h6>
                            <div class="d-flex align-items-center">
                                <div class="stats-icon bg-light-pink rounded-circle p-3 me-3">
                                    <i class="fas fa-dollar-sign text-pink"></i>
                                </div>
                                <div>
                                    <h3 class="mb-0">${{ number_format($investments->sum('amount'), 2) }}</h3>
                                    <div class="d-flex align-items-center mt-2">
                                        <small class="text-muted">{{ $investments->count() }} inversiones en total</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Inversión más reciente -->
                <div class="col-md-6 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h6 class="text-muted mb-3">Inversión más reciente</h6>
                            @if($investments->isNotEmpty())
                                @php
                                    $latestInvestment = $investments->sortByDesc('date')->first();
                                @endphp
                                <div class="d-flex align-items-center">
                                    <div class="stats-icon bg-light-peach rounded-circle p-3 me-3">
                                        <i class="fas fa-calendar-alt text-peach"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0">{{ $latestInvestment->name }}</h5>
                                        <div class="d-flex align-items-center mt-2">
                                            <span class="badge bg-primary me-2">${{ number_format($latestInvestment->amount, 2) }}</span>
                                            <small class="text-muted">{{ \Carbon\Carbon::parse($latestInvestment->date)->format('d M Y') }}</small>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-info mb-0">
                                    <p class="mb-0">No hay inversiones registradas.</p>
                                </div>
                            @endif
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
            document.querySelectorAll('.card, .bg-light, .input-group-text, .form-control').forEach(el => {
                el.classList.add('dark-element');
            });
        }

        function disableDarkMode() {
            body.classList.remove('dark-mode');
            themeSwitcher.innerHTML = '<i class="fas fa-moon"></i>';

            // Revert specific elements
            document.querySelectorAll('.card, .bg-light, .input-group-text, .form-control').forEach(el => {
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

    body.dark-mode .table {
        color: #f5f5f5;
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

    .card, .bg-light, .input-group-text, .form-control {
        transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
    }
</style>
@endsection