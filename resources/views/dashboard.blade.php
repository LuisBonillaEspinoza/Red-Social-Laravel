@extends('app.navbar')

@section('titulo')
    Perfil : {{ $user->username }}
@endsection

@section('contenido')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5">
                @if ($user->imagen)
                    <img src="{{ asset('perfiles/'.$user->imagen) }}" alt="Imagen Usuario" class="shadow-lg rounded-lg h-auto align-middle border-none">
                @else
                    <img src="{{ asset('img/usuario.svg') }}" alt="Imagen Usuario">
                @endif
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:items-start md:justify-center py-10 md:py-10">
                <div class="flex items-center gap-2">
                    <p class="text-gray-700 text-3xl">{{ $user->username }}</p>
                    @auth
                        @if ($user->id == auth()->user()->id)
                            <a href="{{ route('perfil.index',['user' => $user]) }}" class="text-gray-400 hover:text-gray-600 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                </svg>
                                
                            </a>
                        @endif
                    @endauth              
                </div>

                <p class="text-gary-800 text-sm mb-3 font-bold mt-5">
                    {{ $user->followers()->count() }}
                    <span class="font-normal">@choice('Seguidor|Seguidores',$user->followers()->count())</span>
                </p>
                <p class="text-gary-800 text-sm mb-3 font-bold">
                    0
                    <span class="font-normal">Siguiendo</span>
                </p>
                <p class="text-gary-800 text-sm mb-3 font-bold">
                    {{ $user->posts()->count() }}
                    <span class="font-normal">Posts</span>
                </p>

                @auth
                    @if ($user->id== auth()->user()->id)

                    @else
                        @if ($user->siguiendo(auth()->user())) 
                            <form action="{{ route('follow.unfollow',['user' => $user]) }}" method="POST">
                                @method('delete')
                                @csrf
                                <input type="submit" class="bg-red-600 text-white uppercase rounded -lg px-3 py-1 text-xs font-bold cursor-pointer" value="Dejar de Seguir">
                            </form>
                        @else
                            <form action="{{ route('follow.store',['user' => $user]) }}" method="POST">
                                @csrf
                                <input type="submit" class="bg-blue-600 text-white uppercase rounded -lg px-3 py-1 text-xs font-bold cursor-pointer" value="Seguir">
                            </form>
                        @endif
                    @endif
                @endauth
            </div>
        </div>
    </div>

    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>

        @if ($posts->count())

        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-col-4 gap-6">
            @foreach ($posts as $post)
                <div>
                    <a href="{{ route('post.show',['post' => $post, 'user' => $user]) }}">
                        <img src="{{ asset('uploads/'.$post->imagen) }}" alt="Imagen del post {{ $post->titulo }}" class="shadow-lg rounded-lg h-auto align-middle border-none">
                    </a>
                </div>
            @endforeach
        </div>

        <div class="my-10">
            {{ $posts->links('pagination::tailwind') }}
        </div>

        @else

            <p class="text-gary-600 uppercase text-sm text-center font-bold">No Hay Posts</p>
        @endif
    </section>
@endsection