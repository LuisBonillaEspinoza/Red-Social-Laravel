@extends('app.navbar')

@section('titulo')
    {{ $posts->titulo }}
@endsection

@section('contenido')

    <div class="container mx-auto md:flex">
        <div class="md:w-1/2">
            <img src="{{ asset('uploads/'.$posts->imagen) }}" alt="El titulo de la Imagen es : {{ $posts->titulo }}">

            <div class="p-3 flex items-center gap-4">
                @auth
                {{-- Saber si el usuario dio like, para esto entra al metodo en el modelo de post --}}
                    @if ($posts->checkLikes(auth()->user()))
                        <form action="{{ route('like.delete',$posts) }}" method="POST">
                            @method('delete')
                            @csrf
                            <div class="my-4">
                                <button type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                    @else
                        <form action="{{ route('like.store',$posts->id) }}" method="POST">
                            @csrf
                            <div class="my-4">
                                <button type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                    @endif
                
                @endauth
                <p class="font-bold">{{ $posts->likes->count() }} <span class="font-normal">like</span></p>
            </div>

            <div>
                <p class="font-bold">{{ $posts->user->username }}</p>
                {{-- DiffForHumans nos sirve para conocer el tiempo de subido, para esto usa Carbon laravel --}}
                <p class="text-sm text-gray-500">{{ $posts->created_at->diffForHumans() }}</p>   
                <p class="mt-5">{{ $posts->descripcion }}</p>
            </div>
            
            @auth
            {{-- Saber si el usuario que hizo el post lo quiere borrar --}}
                @if ($posts->user->id == auth()->user()->id)
                    <form action="{{ route('post.destroy',['user' => $posts->user->username , 'post' => $posts]) }}" method="POST">
                        @method('delete')
                        @csrf
                        <input type="submit" value="Eliminar Publicacion" class="bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold mt-4
                        cursor-pointer">
                    </form>
                @endif
            @endauth
        </div>

        <div class="md:w-1/2 p-5">
            @auth
            <div class="shadow bg-white p-5 rounded-md">
                <p class="text-xl font-bold text-center mb-4">Agrega un Nuevo Comentario</p>

                <form action="{{ route('comentarios.store',['user' => $posts->user->username, 'post' => $posts]) }}" method="POST">
                    @csrf
                    <div class="mb-5">
                        <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">Comentario</label>
                        <textarea id="comentario" name="comentario" placeholder="Agrega un Comentario" class="border p-3 w-full rounded-lg @error('comentario')
                            border-red-500
                        @enderror">{{ old('comentario') }}</textarea>
                        @error('comentario')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                        @enderror
                    </div>
    
                    <input type="submit" value="Agregar Comentario" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
                </form>
            </div>
            @endauth

            <div class="bg-white mb-5 shadow max-h-96 overflow-y-scroll mt-10">
                @if ($posts->comentarios->count())
                    @foreach ($posts->comentarios as $comentarios)
                        <div class="p-5 border-gray-300 border-b">
                            <a href="{{ route('post.index',['user' => $comentarios->user]) }}" class="font-bold">
                                {{ $comentarios->user->username }}
                            </a>
                            <p>{{ $comentarios->comentario }}</p>
                            <p class="text-sm text-gary-500">{{ $comentarios->created_at->diffForHumans() }}</p>
                        </div>
                    @endforeach
                @else
                    <p class="p-10 text-center">No Hay Comentario</p>
                @endif
            </div>
        </div>
    </div>

@endsection

