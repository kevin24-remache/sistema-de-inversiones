@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-6 bg-white shadow-md rounded-2xl mt-8">
    <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Crear Inversión</h1>

    <form action="{{ route('investments.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700">Nombre:</label>
            <input type="text" name="name" id="name" required
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        <div>
            <label for="amount" class="block text-sm font-semibold text-gray-700">Monto:</label>
            <input type="number" name="amount" id="amount" step="0.01" required
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        <div>
            <label for="date" class="block text-sm font-semibold text-gray-700">Fecha:</label>
            <input type="date" name="date" id="date" required
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        <div>
            <label for="file" class="block text-sm font-semibold text-gray-700">Adjuntar Comprobante (opcional):</label>
            <input type="file" name="file" id="file"
                   class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                          file:rounded-lg file:border-0 file:text-sm file:font-semibold
                          file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
        </div>

        <div class="text-center">
            <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-xl shadow-md transition duration-300">
                Crear Inversión
            </button>
        </div>
    </form>
</div>
@endsection

