<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    // Constructor para proteger las rutas con auth
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // dd('Aquí se muestra el formulario');
        return view('perfil.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd('Guardando cambios');

        // Modificando el request para que no acepte doble username con el slug
        $request->request->add(['username' => Str::slug($request->username)]);

        // Valido el request
        $this->validate($request,[
            'username' => ['required', 'unique:users,username,' . auth()->user()->id, 'min:3','max:20', 'not_in:twittwer,editar-perfil'],
        ]);

        // Valido si hay una imagen
        if ($request->imagen) {
            # code...
            // dd('Si hay una imagen');
            // Obtengo la imagen del formulario
            $imagen = $request->file('imagen');

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
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;

            // Guardamos la imagen, pasándole la ruta
            $imagenServidor->save($imagenPath);
        }

        // Guardar cambios
        $usuario = User::find(auth()->user()->id);

        $usuario->username = $request->username;
        // Si tengo una imagen nueva, o ya existe una imagen en la bd, las tomo, ?? en caso contrario no viene una imagen y queda vacío
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? '';
        $usuario->save();

        // Redirecciono al usuario
        return redirect()->route('posts.index', $usuario->username);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
