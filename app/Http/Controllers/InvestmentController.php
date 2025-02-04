<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\Investment;

class InvestmentController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'file' => 'nullable|file|mimes:jpg,png,pdf|max:2048', // Validar el archivo
        ]);

        // Manejar la subida del archivo
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('investments', 'public'); // Guardar archivo en storage/app/public/investments
        }

        // Crear la inversión y guardar la ruta del archivo
        $investment = new Investment();
        $investment->name = $request->name;
        $investment->amount = $request->amount;
        $investment->date = $request->date;
        $investment->user_id = Auth::id();
        $investment->file_path = $filePath; // Guardar la ruta del archivo
        $investment->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('investments.index')->with('success', 'Investment created successfully.');
    }
}
