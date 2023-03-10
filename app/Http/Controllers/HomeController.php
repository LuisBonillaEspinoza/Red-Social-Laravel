<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        // {{-- Obtener el Id de las personas que seguimos --}}
        // Llamamos al metodo para obtener lose sguidores, con pluck seleccionamos que campo del array necesitamos, y to array convierto en array todo
        // dd(auth()->user()->following->pluck('id')->toArray());

        $id = auth()->user()->following->pluck('id')->toArray();

        $posts = Post::whereIn('user_id',$id)->latest()->paginate(2);

        return view('home',[
            'posts' => $posts,
        ]);
    }
}
