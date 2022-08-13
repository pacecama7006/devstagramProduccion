<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    public function store(Request $request, User $user, Post $post)
    {
        // dd('Comentando');
        // dd($request);
        // dd($post);

        // Validando la información
        $this->validate($request, [
            'comentario' => 'required|max:255',
        ]);

        // Almacenando en la bd
        Comment::create([
            'comment' => $request->comentario,
            'user_id' => auth()->user()->id,
            'post_id' => $post->id
        ]);

        // Lo regreso a la página de crear el mensaje
        return back()->with('mensaje', 'Comentario realizado correctamente');
    }
}
