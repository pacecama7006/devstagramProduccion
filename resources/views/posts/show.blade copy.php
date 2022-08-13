@extends('layouts.app');

@section('titulo')
    {{ $post->titulo }}
@endsection

@section('contenido')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2 p-5">
            <img src="{{ asset('uploads') . '/' .$post->imagen }}" alt="Imagen del post {{ $post->titulo }}">
            <div class="p-3 flex items-center gap-4">
                @auth
                {{-- Así se genera código php en laravel --}}
                {{-- @php
                 $mensaje = 'Hola mundo desde una variable';   
                @endphp --}}
                    {{-- Muestro componente livewire:like-post --}}
                    {{-- Le mando a like-post la variable $post --}}
                    <livewire:like-post :post="$post"/>

                    {{-- Verifico que el usuario autenticado ya haya hecho like --}}
                    {{-- Con el método checkLikes del modelo  post --}}
                    {{-- @if ($post->checkLike(auth()->user()))
                        <form action=" {{ route('posts.likes.destroy', $post )}}" method="POST"> --}}
                            {{-- mÉTODO SPOOFING --}}
                            {{-- @method('DELETE')
                            @csrf
                            <div class="my-4">
                                
                            </div>
                        </form>
                    @else
                        <form action=" {{ route('posts.likes.store', $post )}}" method="POST">
                            @csrf
                            <div class="my-4">
                                <button type="submit">
                                    <svg class="w-6 h-6" fill="white"    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </button>
                            </div>
                        </form>
                    @endif --}}
                     
                @endauth
                {{-- Con la relación de post->likes, cuento los registros --}}
                <p class="font-bold"> 
                    {{ $post->likes->count() }} <span class="font-normal">likes</span>
                </p>
            </div>
            <div>
                <p class="font-bold"> {{ $post->user->username }}</p>
                <p class="text-sm text-gray-500"> 
                    {{ $post->created_at->diffForHumans() }}
                    {{-- {{ $post->created_at->format('d-m-Y') }} --}}
                </p>
                <p class="mt-5">
                    {{ $post->descripcion }}
                </p>
            </div>
            @auth
                @if ($post->user_id === auth()->user()->id)
                    <form action="{{ route('posts.destroy', $post) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <input type="submit" value="Eliminar publicación" class="bg-red-500 hover:bg-red-600 p-2 text-white font-bold mt-4 cursor-pointer rounded-lg">
                    </form>
                @endif                
            @endauth
        </div>
        
        <div class="md:w-1/2 p-5">
            <div class="shadow bg-white p-5 mb-5">
                @auth
                    <p class="text-xl font-bold text-center mb-4">
                        Agrega un nuevo comentario
                    </p>
                    @if(session('mensaje'))
                        <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center font-bold uppercase">
                            {{ session('mensaje') }}
                        </div>
                    @endif
                    <form action="{{ route('comments.store', ['post' => $post, 'user' => $user]) }}" method="POST">
                        @csrf
                        <div class="mb-5">
                            <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">
                                Añade un comentario:
                            </label>
                            <textarea
                                id="comentario" 
                                name="comentario" 
                                placeholder="Comenta la publicación"
                                class="border p-3 w-full rounded-lg @error('comentario') border-red-500 @enderror">    
                            </textarea>
        
                            @error('comentario')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm text-center p-2|">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <input type="submit" value="Comentar"
                        class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">                                        
                    </form>
                @endauth

                <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">
                    {{-- {{ dd($post->comments) }} --}}
                    {{-- Verifico si hay comentarios --}}

                    @if ($post->comments->count())
                        <p class="text-center font-bold text-gray-500 uppercase text-sm">Comentarios:</p>
                        @foreach ($post->comments as $comment)
                            <div class="p-5 border-gray-300 border-b">
                                {{-- Llevo al muro del usuario que hizo el comentario --}}
                                <a href=" {{ route('posts.index', $comment->user) }}" class="font-bold">
                                    {{-- Usuario que hizo el comentario --}}
                                    {{ $comment->user->username }}
                                </a>
                                <p>
                                    {{ $comment->comment }}
                                </p>
                                <p class="text-sm text-gray-500">
                                    {{ $comment->created_at->diffForHumans() }}
                                </p>
                            </div>
                        @endforeach
                    @else
                        <p class="p-10 text-center">
                            No hay comentarios aún.
                        </p>
                    @endif
                </div>
            </div>
        </div>        
    </div>
@endsection