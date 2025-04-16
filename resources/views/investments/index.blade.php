@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md mt-10">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">📈 Mis Inversiones</h1>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-end mb-4">
        <a href="{{ route('investments.create') }}" class="hover:bg-blue-700 text-gray-100 font-semibold py-2 px-4 rounded-lg transition">
            ➕ Crear Nueva Inversión
        </a>
    </div>

    @if ($investments->isEmpty())
        <p class="text-gray-500 text-center">Aún no has registrado inversiones.</p>
    @else
        <ul class="space-y-4">
            @foreach ($investments as $investment)
                <li class="bg-gray-50 p-4 rounded-lg shadow flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800">{{ $investment->name }}</h2>
                        <p class="text-gray-600">${{ number_format($investment->amount, 2) }} — {{ \Carbon\Carbon::parse($investment->date)->format('d M Y') }}</p>
                    </div>

                    <div class="flex space-x-2">
                        <a href="{{ route('investments.edit', $investment->id) }}"
                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg transition">
                            ✏️ Editar
                        </a>

                        <form action="{{ route('investments.destroy', $investment->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta inversión?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-lg transition">
                                🗑️ Borrar
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection