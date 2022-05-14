<!--DESCRIPCION: Vista de edicion de post. Formulario identico al de creación.
Sera procesado por el metodo de update del controlador de post
Se accede por medio de un post que pertenezca al usuario logueado-->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar recomendación') }}
        </h2>
    </x-slot>

    <div class="py-6"> 
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">    
                      <!-- Información operación -->
                      <x-message-status class="mb-4" :status="session('status')" />         
                      <!-- Validation Errors -->
                      <x-auth-validation-errors class="mb-4" :errors="$errors" /> 
                      <form action="{{ url('/post/'.$post->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PATCH') }}
                         @include('post.form')      
                      </form>                  
                        </div>
                    </div>
                </div>
            </div>
         </x-app-layout>