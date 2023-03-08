<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


use Illuminate\Http\Request;

class ImagenController extends Controller
{
    public function store(Request $request){
        $imagen = $request->file('file');

        $nombre_imagen = Str::uuid(). "." . $imagen->extension();

        $imagen_servidor = Image::make($imagen);
        $imagen_servidor->fit(1000,1000);

        $imagenPath = public_path('uploads'). '/'. $nombre_imagen;
        $imagen_servidor->save($imagenPath);

        return response()->json(['imagen' => $nombre_imagen]);
    }

    public function delete(){
        $imagenes = glob(public_path('uploads') . '/*');

        $post = new Post;
        $imagenesBaseDatos = $post::pluck('imagen')->toArray();

        foreach($imagenes as $imagen){
            if(!in_array(basename($imagen),$imagenesBaseDatos)){
                unlink($imagen);
            }
        }
        return response()->json(['mensaje' => 'Imagenes eliminadas']);
    }
}
