<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    //
    public function store(Request $request)
    {
        // $input = $request->all();
        // return response()->json($input);

        // Obtengo la imagen del formulario
        $imagen = $request->file('file');

        // Empezamos a manejar la imagen con intervention
        // Generamos un id único para las imágenes
        $nombreImagen = Str::uuid() . "." . $imagen->extension();

        // Variable para subir la imagen al servidor con intervention
        $imagenServidor = Image::make($imagen);

        // Con image:make podemos acceder a funciones de intervention
        // Le decimos que cada imagen mida 1000 x 1000 px
        $imagenServidor->fit(1000,1000);

        // Creamos la ruta
        // Movemos la imagen del servidor. Con public_path apuntamos
        // a la carpeta public y le pasamos que cree la carpeta uploads
        $imagenPath = public_path('uploads') . '/' . $nombreImagen;

        // Guardamos la imagen, pasándole la ruta
        $imagenServidor->save($imagenPath);


        // return response()->json(['imagen'=> $imagen->extension()]);
        // return response()->json(['imagen'=> 'Probando respuesta']);
        return response()->json(['imagen'=> $nombreImagen]);
    }
}
