<!--DESCRIPCION: Vista con formulario para dejar un comnetario en el post-->

<x-app-layout>
    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dejar un comentario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                   
                    <form action="{{ route('posts.saveComment') }}" method="GET" enctype="multipart/form-data">
                        @csrf
                        <div>

                            

                            <!--Textarea para el mensaje-->
                            <div class="mt-4">
                                <x-label for="text" :value="__('Deja aquí tu comentario')" />
                                <textarea id="text" class="block mt-1 w-full" type="text" name="text" required autofocus></textarea>
                            </div>
                            <div>
                                <x-input id="post_id" class=" mt-1" type="text" name="post_id" hidden
                                value="{{ $id }}" />
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
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
