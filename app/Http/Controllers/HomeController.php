<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Como para poder ver la página principal, deben estar autenticados
    // y si es un usuario que no está registrado, le ponemos el middleware
    // auth para que al teclear en el navegador el endpoint de devstagram
    // lo mande en automático a login o registrarse
    public function __construct()
    {
        $this->middleware('auth');
    }
    // Como sólo va a tener un método, se puede utilizar invoke
    public function __invoke()
    {
        // dd('Desde vista principal');

        // Obtener a quienes seguimos. Con pluck traemos ciertos campos
        // dd(auth()->user()->followings->pluck('id')->toArray());
        $ids = auth()->user()->followings->pluck('id')->toArray();

        // Filtro en posts en base a los ids. Como la información de los
        // ids está en un arreglo, utilizo whereIn y obtengo el resultado
        // ordenándolos del último al primero y me los pagina
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20);
        // dd($posts);

        return view('home', [
            'posts' => $posts
        ]);
    }
}
