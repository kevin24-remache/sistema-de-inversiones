<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('index');
    }

    public function adminDashboard()
    {
        // Verificar si el usuario es admin
        if (!auth()->user()->is_admin) {
            return redirect()->route('investments.index')
                ->with('error', 'No tienes permisos para acceder al panel administrativo');
        }

        return view('admin.dashboard');
    }


}
