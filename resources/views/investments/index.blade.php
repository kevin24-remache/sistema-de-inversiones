<!DOCTYPE html>
<html lang="en">
    @extends('layouts.app')

    @section('content')
        <h1>Mis Inversiones</h1>
        <a href="{{ route('investments.create') }}">Crear una nueva inversion</a>
        <ul>
            @foreach ($investments as $investment)
                <li>
                    {{ $investment->name }} - ${{ $investment->amount }} on {{ $investment->date }}
                    <a href="{{ route('investments.edit', $investment->id) }}">Editar</a>
                    <form action="{{ route('investments.destroy', $investment->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Borrar</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endsection
