<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index() {
        return view('perfil.index');
    }

    public function store(Request $request) {
        
        $request->request->add(['username' => Str::slug($request->username)]);
        $this->validate($request, [
            'username' => ['required','unique:users,username,'. auth()->user()->id,'min:3','max:20', 'not_in:twitter,editar-perfil'],
        ]);

        if($request->imagen) {
            $manager = new ImageManager(Driver::class);

            $imagen = $request->file('imagen');
            $nombreImagen = Str::uuid() . "." . $imagen->extension();
    
            $imagenServidor = $manager->read($imagen);
            $imagenServidor->coverDown(1000,1000);
    
            $imagePath = public_path('perfiles'). '/'. $nombreImagen;
            $imagenServidor->save($imagePath);
        }

        //guardar
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? '';
        $usuario->save();

        //redirect
        return redirect()->route('posts.index', $usuario->username);
    }

}
