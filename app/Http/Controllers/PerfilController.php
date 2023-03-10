<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user){
        if($user->id != auth()->user()->id){
            abort(403);
        }
        return view('perfil.index');
    }

    public function store(Request $request){

        $request->request->add([
            //Quitar Mayusculas y espacios Str::slug
            'username' => Str::slug($request['username']),
        ]);

        $this->validate($request,[
            //not_in: Los nombre que no se pueden usar
            //in : los nombres que se pueden usar
            //unique : nmobre de la tabla,fila de la tabla, auth()->user()->id
            'username' => 'required|unique:users,username,'.auth()->user()->id.'|min:3|max:30',
            'email' => 'required|unique:users,email,'.auth()->user()->id,'|email|max:60',
        ]);

        if($request->imagen){
            $imagen = $request->file('imagen');

            $nombre_imagen = Str::uuid(). "." . $imagen->extension();
    
            $imagen_servidor = Image::make($imagen);
            $imagen_servidor->fit(1000,1000);
    
            $imagenPath = public_path('perfiles'). '/'. $nombre_imagen;
            $imagen_servidor->save($imagenPath);
        }

        $usuario = User::find(auth()->user()->id);
    
        $usuario->username = $request->username;
        $usuario->email = $request->email;
        $usuario->imagen = $nombre_imagen ?? auth()->user()->imagen ?? null;
    
        $usuario->save();
    
        if($request->old_password && $request->newpassword){
            $this->validate($request,
            [
                'old_password' => 'required',
                'newpassword' => 'required',
                'confirmation_newpassword' => 'same:newpassword',
            ]);

            if(Hash::check($request->old_password,auth()->user()->password)){
                $usuario->password = Hash::make($request->newpassword) ?? auth()->user()->password;
                $usuario->save();
            }
            else{
                return back()->with('mensaje', 'La Contraseña Actual no Coincide');
            }
        }

        return redirect()->route('post.index',$usuario->username);
    }
}
