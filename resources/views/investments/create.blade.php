@extends('layouts.app')

@section('content')
    <h1>Crear Inversion</h1>
    <form action="{{ route('investments.store') }}" method="POST">
        @CSRF
        <div>
            <label for="name">Nombre:</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div>
            <label for="amount">Monto:</label>
            <input type="number" name="amount" id="amount" step="0.01" required>
        </div>
        <div>
            <label for="date">Fecha:</label>
            <input type="date" name="date" id="date" required>
        </div>
        <button type="submit">Crear</button>
    </form>
@endsection
