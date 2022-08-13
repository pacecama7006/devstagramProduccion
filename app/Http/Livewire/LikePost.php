<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    // Creando un atributo
    // Este atributo lo mando a la vista donde estoy poniendo el componente
    // livewire
    // public $mensaje = 'Hola mundo desde un atributo';
    // Este atributo lo recibo de la vista donde estoy poniendo el componente
    // public $mensaje;
    // Variable para recibir los post
    public $post;
    // Variable para indicar si ya se le dió like y que me cambie el color del corazon
    public $isLiked;

    // Variable likes
    public $likes;

    /**Función que se va a ejecutar automáticamente cuando sea instanciado
     * este like-post. Es como un constructor en php. En livewire se llama
     * mount
     */
    public function mount($post)
    {
        /**Le decimos que cheque si el usuario actual ya dio like */
        $this->isLiked = $post->checkLike(auth()->user());
        $this->likes = $post->likes->count();
    }

    // Función que está en like-post.blade en el evento click
    public function like()
    {
        /*Verifico que el usuario autenticado ya haya hecho like
        Con el método checkLikes del modelo  post*/
        if ( $this->post->checkLike(auth()->user())){
            // Si ya le dió me gusta, elimino el like
            // Con el request tengo el usuario que dió eliminar, accedo a el
            // y con la relación con likes verifico el post_id para eliminarlo
            // de la bd
            $this->post->likes()->where('post_id', $this->post->id)->delete();
            // Hago reactivo con livewire
            $this->isLiked = false;
            //Rebajo la cantidad que tenga cada vez que un usuario quite su like
            $this->likes--;
        }else{
            // Con la relación de post, creamos el like
            $this->post->likes()->create([
                'user_id' => auth()->user()->id,
            ]);
            // Hago reactivo con livewire
            $this->isLiked = true;
            // Aumento cuando le dan like
            $this->likes++;
        }
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}
