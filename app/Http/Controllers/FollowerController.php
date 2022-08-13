<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follower;
use Illuminate\Http\Request;

class FollowerController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $user)
    {
        //El $user es a quien voy a seguir y en el request aparecera el follower
        // dd($user->username);
        // dd($request);

        // Creo al seguidor con la relación de user->followers
        // El método attach sirve para almacenar en bd cuando se tiene
        // relación de muchos a muchos. Almaceno el usuario que 
        // está autentificado y que está visitando el muro de alguien para
        // seguirlo
        $user->followers()->attach(auth()->user()->id);

        // Lo regreso al muro
        return back();

    }

    public function destroy (User $user)
    {
        //El $user es a quien voy a dejar seguir y en el request aparecera el follower
        // dd($user->username);
        // dd($request);

        // Creo al seguidor con la relación de user->followers
        // El método attach sirve para almacenar en bd cuando se tiene
        // relación de muchos a muchos. Almaceno el usuario que 
        // está autentificado y que está visitando el muro de alguien para
        // seguirlo
        $user->followers()->detach(auth()->user()->id);

        return back();
    }

}
