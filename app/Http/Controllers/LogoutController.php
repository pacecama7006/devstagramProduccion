<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    //
    public function store()
    {
        // dd('Cerrando sesión');
        // Cierro sesión
        auth()->logout();
        // Lo mando al formulario del login
        return redirect()->route('login');
    }
}
