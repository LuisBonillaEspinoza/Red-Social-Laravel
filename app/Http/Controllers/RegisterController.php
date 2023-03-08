<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function index(){
        return view('auth.register');
    }

    public function store(Request $request){
        //Validacion

        //Mayor Validacion para el usuarios

        $request->request->add([
            //Quitar Mayusculas y espacios Str::slug
            'username' => Str::slug($request['username']),
        ]);
        $this->validate($request,[
            'name' => 'required|max:30',
            'username' => 'required|unique:users|min:3|max:30',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|min:3',
            'password_confirmation' => 'required|same:password'
        ]);

        User::create([
            'name' => $request['name'],
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        //Autenticar un usuario
        // auth()->attempt([
        //     'email' => $request['email'],
        //     'password' => $request['password']
        // ]);

        auth()->attempt($request->only('email','password'));

        return redirect()->route('post.index',['user' => auth()->user()->username]);
    }
}
