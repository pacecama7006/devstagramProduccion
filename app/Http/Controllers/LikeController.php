<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    //
    public function store(Request $request, Post $post)
    {
        // dd('Dando like');
        // dd($post->id);
        // Con la relación de post, creamos el like
        $post->likes()->create([
            'user_id' => $request->user()->id,

        ]);

        // Lo regreso a la misma página del post donde hizo like
        return back();
    }

    public function destroy(Request $request, Post $post){
        // dd('Eliminando like');
        // Con el request tengo el usuario que dió eliminar, accedo a el
        // y con la relación con likes verifico el post_id para eliminarlo
        // de la bd
        $request->user()->likes()->where('post_id', $post->id)->delete();

        return back();
    }
}
