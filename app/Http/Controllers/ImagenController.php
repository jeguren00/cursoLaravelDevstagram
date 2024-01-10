<?php
namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImagenController extends Controller
{
    public function store(Request $request) {
        $manager = new ImageManager(Driver::class);

        $imagen = $request->file('file');
        $nombreImagen = Str::uuid() . "." . $imagen->extension();

        $imagenServidor = $manager->read($imagen);
        $imagenServidor->coverDown(1000,1000);

        $imagePath = public_path('uploads'). '/'. $nombreImagen;
        $imagenServidor->save($imagePath);
        return response()->json(['imagen' => $nombreImagen]);
    }
}
