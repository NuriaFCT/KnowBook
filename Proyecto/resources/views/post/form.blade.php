<!--DESCRIPCION: Componente usado para la creación y edicion de post. Ahorra codigo-->

<!--Imagen se ha de poner una por defecto-->
<div>
    <x-label for="image" :value="__('Imagen de portada')" />

    <x-input id="image" class=" mt-1" type="file" name="image" value="{{ isset($post->image)?$post->image:'' }}" />
    {{-- <img class="inline object-cover w-12 h-12 mr-2 rounded-full" src="{{ route('user.avatar', ['filename'=>Auth::user()->image])}}" alt="Profile image"/> --}}
    <div class="flex flex-wrap justify-center mt-2">
        <div class="w-6/12 sm:w-4/12 px-4">
            <!--<img src="{{-- route('post.image', ['filename'->image])--}}" alt="Imagen de portada" class="shadow rounded max-w-full h-auto align-middle border-none" />--->
            <!-- 
              {{--@if(isset($user->image))--}}
              <img src="{{--asset('storage/app/users').'/'.$user->image--}}" alt=" " width="100">
              {{--@endif--}}
            -->
          </div>
    </div>
    <!--<img src="..." class="img-fluid" alt="Imagen de portada">-->
</div>

 <!-- Titulo -->
 <div class="mt-4">
    <x-label for="titulo" :value="__('Titulo')" />
    <x-input id="titulo" class="block mt-1 w-full" type="text" name="titulo" value="{{isset($post->title)?$post->title:''}}" required autofocus />
</div>

<!--Descripcion-->
<div class="mt-4">
    <x-label for="description" :value="__('Descripción')" />
    <textarea id="description" class="block mt-1 w-full" type="text" name="description" required autofocus>{{isset($post->description)?$post->description:''}}</textarea>
</div>


 <!-- Obtenerlo en... -->
 <div class="mt-4">
    <x-label for="obtenerlo" :value="__('Obtenerlo en')" />
    <x-input id="obtenerlo" class="block mt-1 w-full" type="text" name="obtenerlo" value="{{isset($post->buy_on)?$post->buy_on:''}}" required autofocus />
</div>

<!--Boton Enviar y regresar -->
<div class="flex items-center justify-end mt-4">
    <x-button class="ml-4">
        {{ __('Guardar cambios') }}
    </x-button>
    <a href="{{ url('dashboard/') }}">
      <input type="button" class='inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ' style="background-color: #a05a2c; margin-left: 4px" value="Regresar">
    </a>
</div>