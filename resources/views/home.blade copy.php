@extends('layouts.app')

@section('titulo')
    Página principal
@endsection()
@section('contenido')
    {{-- Paso la variable post que viene del controlador home --}}
    <x-listar-post :posts=$posts>
        {{-- Puedo nombrar los slots --}}
        {{-- <x-slot:titulo>
            <header>Esto es un header</header>
        </x-slot:titulo> --}}
        {{-- <h1>Mostrando posts desde slots</h1> --}}
    </x-listar-post>
@endsection()
