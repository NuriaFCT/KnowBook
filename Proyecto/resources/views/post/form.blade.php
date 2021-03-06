<!--DESCRIPCION: Componente usado para la creación y edicion de post. Ahorra codigo
Se usó en un principio, pero fue retirado tras problemas que daba-->

<!--Imagen se ha de puesto una por defecto en caso de no tener. La idea es que al subir la foto, se ponga en su lugar al editar-->
<div>
    @if (isset($post->image))
        <div class="bg-indigo-300 flex flex-wrap justify-center ">
            <img src="{{ url('img/posts/' . $post->image) }}" height="100" width="80%"
                class="img-thumbnail rounded float-left mr-3" />
        </div>
    @else
        <div class="bg-indigo-300 flex flex-wrap justify-center ">
            <img class="object-cover" src={{ URL::asset('/img/posts/bookpre.jpg') }}
                style="height: 400px; width:400px;">
        </div>
    @endif

    <!--Imagen-->
    <x-label for="image" :value="__('Imagen de portada')" />

    <x-input id="image" class=" mt-1" type="file" name="image"
        value="{{ isset($post->image) ? $post->image : '' }}" />

    <!--Titulo-->
    <div class="mt-4">
        <x-label for="titulo" :value="__('Titulo')" />
        <x-input id="titulo" class="block mt-1 w-full" type="text" name="titulo"
            value="{{ isset($post->title) ? $post->title : '' }}" required autofocus />
    </div>

    <!--Descripcion-->
    <div class="mt-4">
        <x-label for="description" :value="__('Descripción')" />
        <textarea id="description" class="block mt-1 w-full" type="text" name="description" required autofocus>{{ isset($post->description) ? $post->description : '' }}</textarea>
    </div>

    <!--Obtenerlo en...-->
    <div class="mt-4">
        <x-label for="obtenerlo" :value="__('Obtenerlo en')" />
        <x-input id="obtenerlo" class="block mt-1 w-full" type="text" name="obtenerlo"
            value="{{ isset($post->buy_on) ? $post->buy_on : '' }}" required autofocus />
    </div>

    <!--Boton Enviar y regresar -->
    <div class="flex items-center justify-end mt-4">
        <x-button class="ml-4">
            {{ __('Guardar cambios') }}
        </x-button>
        <a href="{{ url('dashboard/') }}">
            <input type="button"
                class='inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 '
                style="background-color: #a05a2c; margin-left: 4px" value="Regresar">
        </a>
    </div>
