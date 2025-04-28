<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Setting;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!auth()->user() || !auth()->user()->is_admin) {
                return response()->json(['error' => 'No autorizado'], 403);
            }

            return $next($request);
        });
    }

    public function getClients()
    {
        $clients = User::where('status', 'approved')
                       ->where('is_admin', false)
                       ->get();
        return response()->json($clients);
    }

    public function getPendingClients()
    {
        $pendingClients = User::where('status', 'pending')
                             ->where('is_admin', false)
                             ->get();
        return response()->json($pendingClients);
    }

    public function approveClient($id)
    {
        $client = User::findOrFail($id);
        $client->status = 'approved';
        $client->save();

        return response()->json(['message' => 'Cliente aprobado exitosamente']);
    }

    public function rejectClient($id)
    {
        $client = User::findOrFail($id);
        $client->status = 'rejected';
        $client->save();

        return response()->json(['message' => 'Cliente rechazado']);
    }

    public function updateClient(Request $request, $id)
    {
        $client = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'investment' => 'required|numeric|min:0',
        ]);

        $client->name = $validated['name'];
        $client->email = $validated['email'];
        $client->investment = $validated['investment'];
        $client->save();

        return response()->json(['message' => 'Cliente actualizado exitosamente']);
    }

    public function deleteClient($id)
    {
        $client = User::findOrFail($id);
        $client->delete();

        return response()->json(['message' => 'Cliente eliminado exitosamente']);
    }

    public function updateInvestmentRate(Request $request)
    {
        $validated = $request->validate([
            'rate' => 'required|numeric|min:0|max:100',
        ]);

        // Usando un modelo Setting para almacenar la configuración
        $settings = Setting::firstOrCreate(['key' => 'investment_rate'], [
            'value' => 3.0 // Valor predeterminado
        ]);

        $settings->value = $validated['rate'];
        $settings->save();

        return response()->json(['message' => 'Tasa de inversión actualizada exitosamente']);
    }
}