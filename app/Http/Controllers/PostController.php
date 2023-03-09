<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Faker\Core\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Str;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['show','index']);
    }
    
    public function index(User $user){
        // Sin Paginado
        // $posts = Post::where('user_id',$user->id)->get();

        //Con Paginado de 3
        $posts = Post::where('user_id',$user->id)->paginate(3);

        return view('dashboard',[
            'user' => $user,
            'posts' => $posts,
        ]);
    }

    public function create(){
        return view('post.create');
    }

    public function store(Request $request){
        $this->validate($request,[
            'titulo' => 'required|max:250',
            'descripcion' => 'required|max:250',
            'imagen' => 'required'
        ]);

        // Post::create([
        //     'titulo' => $request['titulo'],
        //     'descripcion' => $request['descripcion'],
        //     'imagen' => $request['imagen'],
        //     'user_id' => auth()->user()->id,
        // ]);

        //Otra manera de hacer insert into
        $request->user()->posts()->create([
            'titulo' => $request['titulo'],
            'descripcion' => $request['descripcion'],
            'imagen' => $request['imagen'],
            'user_id' => auth()->user()->id,
            //Str::slug nos ayuda a hacer la url mas amigable
            'slug' => Str::slug($request['titulo']),
        ]);

        return redirect()->route('post.index',auth()->user()->username);
    }

    public function show(User $user,Post $post){
        return view('post.show',[
            'posts' => $post
        ]);
    }

    //Agregar esto al usar politicas
    public function authorize($ability, $arguments = [])
    {
        return true;
    }

    public function destroy(User $user,Post $post){
        // if($post->user->id == auth()->user()->id){
        //     dd('Misma persona');
        // }
        // dd('No es la misma persona');

        //Otra forma usnado Policy
        $this->authorize('delete',$post);

        $post->delete();

        //Eliminado la imagen
        $imagen_path = public_path('uploads/'.$post->imagen);

        if(FacadesFile::exists($imagen_path)){
            unlink($imagen_path);
        }

        return redirect()->route('post.index',['user' => $user]);
    }
}
