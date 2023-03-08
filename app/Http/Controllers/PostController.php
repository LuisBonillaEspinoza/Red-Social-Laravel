<?php

namespace App\Http\Controllers;

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

        return view('dashboard',[
            'user' => $user
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
    }
}
