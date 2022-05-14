<!--DESCRIPCION: Vista de creación de post. Será por medio de un formulario que recogerá el metodo store del controlador de libros
Se accede a este por mediom del menu bar-->


<x-app-layout>
    <x-slot name="header">
        <!--
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{--__('Subir recomendación')--}}
        </h2>-->
    </x-slot>

    <div class="py-6"> 
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">    
                      <!-- Información operación -->
                      <x-message-status class="mb-4" :status="session('status')" />         
                      <!-- Validation Errors -->
                      <x-auth-validation-errors class="mb-4" :errors="$errors" />
                     <form method="POST" action="{{ url('/dashboard') }}" enctype="multipart/form-data">
                         @csrf 
                         @include('post.form')  
                     </form>     
                    </div>
                </div>
            </div>
          </div>
          </x-app-layout>
