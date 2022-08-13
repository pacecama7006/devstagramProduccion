@extends('layouts.app')

@section('titulo')
    Perfil: {{ $user->username }}
@endsection

@section('contenido')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5">
                <img src="{{ $user->imagen ? asset('perfiles') . '/' . $user->imagen : asset('img/usuario.svg') }}" alt="Imagen del usuario">
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10 md:py-10">
                {{-- {{ dd($user) }} --}}
                <div class="flex items-center gap-2">
                    <p class="text-gray-700 text-2xl">
                        {{ $user->username }}
                    </p>

                    @auth
                    {{-- Si el usuario que esta en el muro es el usuario original --}}
                        @if ($user->id === auth()->user()->id)
                            {{-- Le muestro un enlace para modificar su perfil --}}
                            <a href="{{ route('perfil.index') }}" class="text-gray-500 hover:text-gray-600 cursor-pointer">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                </svg>
                            </a>                        
                        @endif
                    @endauth
                </div>
                <p class="text-gray-800 text-sm font-bold mb-3 mt-5">
                    {{-- En base a la relación le cuento el número de seguidores --}}
                    {{ $user->followers->count(); }}
                    {{-- En base a la cantidad con choice le decimos que
                        ponga seguidor o seguidores --}}
                    <span class="font-normal">@choice('Seguidor|Seguidores', $user->followers->count())</span>
                </p>
                <p class="text-gray-800 text-sm font-bold mb-3">
                    {{ $user->followings->count(); }}
                    <span class="font-normal">Siguiendo</span>
                </p>
                <p class="text-gray-800 text-sm font-bold mb-3">
                    {{-- Cuento los posts con la relación user-posts que
                        accede a la bd --}}
                    {{ $user->posts->count() }}
                    <span class="font-normal">Posts</span>
                </p>
                @auth
                {{-- Si el usuario del muro al que voy a seguir es diferente al usuario autentificado, puede ver el form--}}
                    @if ($user->id !== auth()->user()->id)
                    {{-- El usuario autenticado visita el muro de otro usuario, si no lo está siguiendo, le muestro el botón de seguir, si lo está siguiendo, le muestro el botón de dejar de seguir. $user es el usuario al que visito el muro y en siguiendo paso al usuario autenticado --}}
                        @if (!$user->siguiendo(auth()->user()))
                            <form action="{{ route('users.follow', $user) }}" method="POST">
                                @csrf

                                <input type="submit" value="Seguir" class="bg-blue-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer">
                            </form>
                        @else  
                            <form action="{{ route('users.unfollow', $user) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <input type="submit" value="Dejar de seguir" class="bg-red-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer">
                            </form>
                        @endif
                    @endif
                @endauth
            </div>
        </div>
    </div>
    <section class="container mx:auto mt-10">
        <h2 class="text-4xl font-black my-10 text-center">Publicaciones</h2>


        {{-- Utilizo componente listar-post --}}
        <x-listar-post :posts=$posts>

        </x-listar-post>
        
    </section>
@endsection