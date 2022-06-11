<!--DESCRIPCION: Vista con el listado de comentarios del post concreto-->
<x-app-layout>
    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Comentarios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

<!--Si hay, los mostrará-->
                    @if(count($datos)>0)

                        @foreach ($datos as $dato)
                            <table class="rounded overflow-hidden shadow-lg mb-4"
                                style="background-color: #f7e5d8; border: 2px solid black; width:100%; height:100px">
                                <tr>
                                    <td rowspan="3" style="width:20%">
                                        <!--Imagen del usuario que lo ha dejado-->
                                        @if (isset($dato->image_profile))
                                            <div class="bg-indigo-300 flex flex-wrap justify-center">
                                                <img class="max-w-full h-auto rounded-full"
                                                    src="{{ url('img/users/' . $dato->image_profile) }}"
                                                    style="height: 100px; width:100px;">
                                            </div>
                                        @else
                                            <div class="bg-indigo-300 flex flex-wrap justify-center">
                                                <img class="max-w-full h-auto rounded-full"
                                                    src="{{ url('img/users/avatar.png') }}" style=" height: 100px;
                                            width:100px;">
                                            </div>
                                        @endif
                                    </td>
                                    <!--Su nombre-->
                                    <td ><strong>{{ $dato->name }}</strong></td>
                                    <tr>
                                    <!--Texto dejado-->    
                                        <td >{{ $dato->text }}</td>
                                    </tr>    
                                </tr>
                        @endforeach
                    <!--Si no los hay, indicará que no hay ninguno-->    
                    @else

                            <div class="flex flex-wrap justify-center">
                                <div class="w-6/12 sm:w-4/12 px-4">
                                <img src="{{url('img/vectorLibroBW.png') }}" alt="VectorLibro" class="shadow rounded max-w-full h-auto align-middle border-none" style="opacity: 0.4" />
                                </div>
                            </div>

                            <div class="h-screen flex flex-col items-center justify-center border-none">
                                    <p class="text-xl mb-3 ">
                                        ¡Ups! No hay <strong>comentarios</strong> en esta publicación. ¡Sé el primero en dejar uno!
                                    </p>
                            </div>
                    
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
