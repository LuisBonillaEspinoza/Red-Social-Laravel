@extends('app.navbar')

@section('titulo')
    Editar Perfil : {{ auth()->user()->username }}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form action="{{ route('perfil.store',['user' => auth()->user()]) }}" method="POST" class="mt-10 md:mt-0" enctype="multipart/form-data">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Username</label>
                    <input type="text" id="username" name="username" placeholder="Tu Nombre de Usuario" class="border p-3 w-full rounded-lg 
                    @error('username')
                        border-red-500
                    @enderror" value="{{ auth()->user()->username }}">
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div> 

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
                    <input type="email" id="email" name="email" placeholder="Tu Email de Registro" class="border p-3 w-full rounded-lg
                    @error('email')
                        border-red-500
                    @enderror" value="{{ auth()->user()->email }}">
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">Imagen Perfil</label>
                    <input type="file" accept=".jpg,.png,.jpge" id="imagen" name="imagen" placeholder="Tu Nombre de Usuario" class="border p-3 w-full rounded-lg">
                </div> 

                <div class="mb-5">
                    <label for="old-password" class="mb-2 block uppercase text-gray-500 font-bold">Password</label>
                    <input type="password" id="old-password" name="old_password" placeholder="Tu Contraseña" class="border p-3 w-full rounded-lg 
                    @error('password')
                        border-red-500
                    @enderror">
                    @if(Session::has('mensaje'))
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ Session::get('mensaje') }}</p>
                    @endif
                </div> 

                <div class="mb-5">
                    <label for="newpassword" class="mb-2 block uppercase text-gray-500 font-bold">Nueva Contraseña</label>
                    <input type="password" id="newpassword" name="newpassword" placeholder="Tu Nueva Contraseña" class="border p-3 w-full rounded-lg 
                    @error('newpassword')
                        border-red-500
                    @enderror">
                    @error('newpassword')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div> 

                <div class="mb-5">
                    <label for="confirmation-newpassword" class="mb-2 block uppercase text-gray-500 font-bold">Confirmar Nueva Contraseña</label>
                    <input type="password" id="confirmation-newpassword" name="confirmation_newpassword" placeholder="Confirmar Nueva Contraseña" class="border p-3 w-full rounded-lg 
                    @error('confirmation_newpassword')
                        border-red-500
                    @enderror">
                    @error('confirmation_newpassword')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div> 

                <input type="submit" value="Guardar Cambios" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection