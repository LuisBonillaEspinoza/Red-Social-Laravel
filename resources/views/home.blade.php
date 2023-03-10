@extends('app.navbar')

@section('titulo','Principal')

@section('contenido')
    @if ($posts->count())
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-col-4 gap-6">
            @foreach ($posts as $post)
                <div>
                    <a href="{{ route('post.show',['post' => $post, 'user' => $post->user]) }}">
                        <img src="{{ asset('uploads/'.$post->imagen) }}" alt="Imagen del post {{ $post->titulo }}" class="shadow-lg rounded-lg h-auto align-middle border-none">
                    </a>
                </div>
            @endforeach
        </div>

        <div class="my-10">
            {{ $posts->links('pagination::tailwind') }}
        </div>
    @else
        <p class="text-center">No Hay Posts,sigue a alguien para poder ver los posts</p>
    @endif
@endsection