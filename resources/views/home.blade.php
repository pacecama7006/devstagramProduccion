@extends('layouts.app')

@section('titulo')
    Página principal
@endsection()
@section('contenido')
    {{-- Utilizo el componente <-listar-post --}}
    {{-- Paso la variable post que viene del controlador listar-post.php y que viene de HomeController para pasarla al componente --}}
    <x-listar-post :posts=$posts>

    </x-listar-post>
@endsection()
