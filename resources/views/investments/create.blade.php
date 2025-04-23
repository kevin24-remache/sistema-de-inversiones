@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mt-4">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">Crear Inversión</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('investments.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">Nombre:</label>
                            <input type="text" name="name" id="name" required
                                class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="amount" class="form-label fw-bold">Monto:</label>
                            <input type="number" name="amount" id="amount" step="0.01" required
                                class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="date" class="form-label fw-bold">Fecha:</label>
                            <input type="date" name="date" id="date" required
                                class="form-control">
                        </div>

                        <div class="mb-4">
                            <label for="file" class="form-label fw-bold">Adjuntar Comprobante:</label>
                            <input type="file" name="file" id="file"
                                class="form-control">
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary px-4 py-2">
                                Crear Inversión
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection