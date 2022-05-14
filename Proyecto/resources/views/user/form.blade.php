<!--DESCRIPCION: Componente usado para edicion de usuario. Ahorra codigo-->

<!--Imagen se ha de poner una por defecto-->
<div>
    <x-label for="image_profile" :value="__('Imagen de perfil')" />

    <x-input id="image_profile" class=" mt-1" type="file" name="image_profile" value="{{ isset($user->image_profile)?$user->image_profile:'' }}" />
    {{-- <img class="inline object-cover w-12 h-12 mr-2 rounded-full" src="{{ route('user.avatar', ['filename'=>Auth::user()->image])}}" alt="Profile image"/> --}}
    <div class="flex flex-wrap justify-center mt-2">
        <div class="w-6/12 sm:w-4/12 px-4">
            <!--<img src="{{-- route('user.image', ['filename'=>Auth::user()->image])--}}" alt="Imagen de perfil" class="shadow rounded max-w-full h-auto align-middle border-none" />--->
            <!-- 
              {{--@if(isset($user->image))--}}
              <img src="{{--asset('storage/app/users').'/'.$user->image--}}" alt=" " width="100">
              {{--@endif--}}
            -->
          </div>
    </div>
    <!--<img src="..." class="img-fluid" alt="Imagen de portada">-->
</div>


<!-- Name -->
<div class="mt-4">
    <x-label for="name" :value="__('Nombre')" />
    <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{isset($user->name)?$user->name:''}}" required autofocus />
</div>

<!--Descripcion-->
<div class="mt-4">
    <x-label for="biography" :value="__('Biografía')" />
    <textarea id="biography" class="block mt-1 w-full" type="text" name="biography" autofocus>{{isset($user->biography)?$user->biography:''}}</textarea>
</div>

<!--Boton Enviar y regresar -->
<div class="flex items-center justify-end mt-4">
    <x-button class="ml-4">
        {{ __('Guardar cambios') }}
    </x-button>
    <a href="{{ url('user/profile/') }}">
      <input type="button" class='inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ' style="background-color: #a05a2c; margin-left: 4px" value="Regresar">
    </a>
</div>