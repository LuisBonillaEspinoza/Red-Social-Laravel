@extends('app.navbar')

@section('titulo')
    {{ $posts->titulo }}
@endsection

@section('contenido')

    <div class="container mx-auto flex">
        <div class="md:w-1/2">
            <img src="{{ asset('uploads/'.$posts->imagen) }}" alt="El titulo de la Imagen es : {{ $posts->titulo }}">

            <div class="p-3">
                <p>0 likes</p>
            </div>

            <div>
                <p class="font-bold">{{ $posts->user->username }}</p>
                {{-- DiffForHumans nos sirve para conocer el tiempo de subido, para esto usa Carbon laravel --}}
                <p class="text-sm text-gray-500">{{ $posts->created_at->diffForHumans() }}</p>   
                <p class="mt-5">{{ $posts->descripcion }}</p>
            </div>
            
        </div>

        <div class="md:w-1/2 p-5">
            <div class="shadow bg-white p-5">
                <p class="text-xl font-bold text-center mb-4">Agrega un Nuevo Comentario</p>

                <form action="">
                    <div class="mb-5">
                        <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">Comentario</label>
                        <textarea id="comentario" name="comentario" placeholder="Agrega un Comentario" class="border p-3 w-full rounded-lg @error('comentario')
                            border-red-500
                        @enderror">{{ old('comentario') }}</textarea>
                        @error('comentario')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                        @enderror
                    </div>
    
                    <input type="submit" value="Crear Publicacion" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
                </form>
            </div>
        </div>
    </div>

@endsection

