<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Función que nos permite
     * visualizar la vista register
     * 
     * @return registerView
     */
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // dd('Post');
        // Accedo a todos los valores
        // dd($request);
        // Accedo a propiedades del request
        // dd($request->get('name'));

        // Modificando el request para que no acepte doble username con el slug
        $request->request->add(['username' => Str::slug($request->username)]);

        // Validación
        $this->validate($request, [
            'name'=> 'required|max:5',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:8',
        ]);

        // dd('Creando usuario');
        // Crea al usuario y lo sube a la bd
        User::create([
            'name'=> $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' =>Hash::make( $request->password)
        ]);

        // Autenticar un usuario
        // auth()->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password,
        // ]);

        // Otra forma de autenticar
        auth()->attempt($request->only('email', 'password'));

        // Redirecciono
        return redirect()->route('posts.index');

    }
}
