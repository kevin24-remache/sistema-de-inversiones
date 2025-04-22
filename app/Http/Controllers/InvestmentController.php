<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\Investment;
use Illuminate\Support\Facades\Storage;

class InvestmentController extends Controller
{
    public function index()
    {
        $investments = Investment::where('user_id', Auth::id())->get();
        return view('investments.index', compact('investments'));
    }

    public function create()
    {
        return view('investments.create');
    }

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
        return redirect()->route('investments.index')->with('success', 'Inversión creada correctamente.');
    }

    /**
     * Show the form for editing the specified investment.
     *
     * @param  \App\Models\Investment  $investment
     * @return \Illuminate\Http\Response
     */
    public function edit(Investment $investment)
    {
        // Verificar que la inversión pertenece al usuario actual
        if ($investment->user_id !== Auth::id()) {
            return redirect()->route('investments.index')
                ->with('error', 'No tienes permiso para editar esta inversión.');
        }

        return view('investments.edit', compact('investment'));
    }

    /**
     * Update the specified investment in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Investment  $investment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Investment $investment): RedirectResponse
    {
        // Verificar que la inversión pertenece al usuario actual
        if ($investment->user_id !== Auth::id()) {
            return redirect()->route('investments.index')
                ->with('error', 'No tienes permiso para actualizar esta inversión.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'file' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
        ]);

        // Manejar la subida del archivo si hay uno nuevo
        if ($request->hasFile('file')) {
            // Eliminar el archivo anterior si existe
            if ($investment->file_path) {
                Storage::disk('public')->delete($investment->file_path);
            }

            $filePath = $request->file('file')->store('investments', 'public');
            $investment->file_path = $filePath;
        }

        // Actualizar los campos
        $investment->name = $request->name;
        $investment->amount = $request->amount;
        $investment->date = $request->date;
        $investment->save();

        return redirect()->route('investments.index')
            ->with('success', 'Inversión actualizada correctamente.');
    }

    /**
     * Remove the specified investment from storage.
     *
     * @param  \App\Models\Investment  $investment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Investment $investment): RedirectResponse
    {
        // Verificar que la inversión pertenece al usuario actual
        if ($investment->user_id !== Auth::id()) {
            return redirect()->route('investments.index')
                ->with('error', 'No tienes permiso para eliminar esta inversión.');
        }

        // Eliminar el archivo asociado si existe
        if ($investment->file_path) {
            Storage::disk('public')->delete($investment->file_path);
        }

        $investment->delete();

        return redirect()->route('investments.index')
            ->with('success', 'Inversión eliminada correctamente.');
    }
}