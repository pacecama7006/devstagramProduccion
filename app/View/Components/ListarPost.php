<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ListarPost extends Component
{
    // Creo variable que está en homeController para pasarla al constructor
    public $posts;
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public function __construct($posts)
    {
        //Le doy valor a la variable, para que la mande a la vista
        $this->posts = $posts;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.listar-post');
    }
}
