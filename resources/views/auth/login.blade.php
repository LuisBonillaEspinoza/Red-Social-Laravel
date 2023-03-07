@extends('app.navbar')

@section('titulo')
    Inicia Sesion en Testagram
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="p-5 {{ $errors->has('name') || $errors->has('username') || $errors->has('email') ||
        $errors->has('password') || $errors->has('password_confirmation') ? 'md:w-9/12' : 'md:w-7/12' }}">
            <img src="{{ asset('img/login.jpg') }}" alt="Imagen de Login de Usuario">
        </div>

        <div class="md:w-4/12 bg-white rounded-lg p-6 shadow-lg">
            <form action="{{ route('login.store') }}" method="Post" novalidate>
                @csrf

                @if (session('message'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ session('message') }}</p>
                @endif
                
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
                    <input type="email" id="email" name="email" placeholder="Email de Inicio de Sesion" class="border p-3 w-full rounded-lg
                    @error('email')
                        border-red-500
                    @enderror" value="{{ old('email') }}">
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password de Inicio de Sesion" class="border p-3 w-full rounded-lg
                    @error('password')
                        border-red-500
                    @enderror">
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <input type="checkbox" name="remember" id="remember"><label class="text-gray-500 text-sm ml-1" for="remember">Mantener mi Sesion Abierta</label>
                </div>

                <input type="submit" value="Iniciar Sesion" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection