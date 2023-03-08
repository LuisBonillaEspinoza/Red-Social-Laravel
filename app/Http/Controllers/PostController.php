<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
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
        ]);

        return redirect()->route('post.index',auth()->user()->username);
    }
}
