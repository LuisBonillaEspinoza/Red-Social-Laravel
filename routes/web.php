<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


//Registro y Login
Route::get('/register',[RegisterController::class,'index'])->name('registro.index');
Route::post('/register',[RegisterController::class,'store'])->name('registro.store');

Route::get('/login',[LoginController::class,'index'])->name('login.index');
Route::post('/login',[LoginController::class,'store'])->name('login.store');

Route::post('/logout',[LogoutController::class,'store'])->name('logout.store');

//Vista del Usuario
Route::get('/{user:username}',[PostController::class,'index'])->name('post.index');

//Crear Post
Route::get('/post/create',[PostController::class,'create'])->name('post.create');
Route::post('/post/create',[PostController::class,'store'])->name('post.store');

//Imagenes del Post
Route::post('/imagen',[ImagenController::class,'store'])->name('imagen.store');
Route::get('/imagen/delete',[ImagenController::class,'delete']);

//Mostrar Datos del Post
Route::get('{user:username}/post/{post:slug}',[PostController::class,'show'])->name('post.show');

//Comentarios
Route::post('{user:username}/post/{post:slug}',[ComentarioController::class,'store'])->name('comentarios.store');

//Eliminar Post
Route::delete('{user:username}/post/{post:slug}',[PostController::class,'destroy'])->name('post.destroy');




