<!--DESCRIPCION: Vista en detalle o individual de los post. Se accedera a los comentarios y al contenido entero-->

<x-app-layout>
    <x-slot name="header">
        
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Más información sobre el libro')}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!--Autor: Foto, fecha y nickname-->
                    <table class=" overflow-hidden mb-4" style="width:100%; height:100px; margin-left: 50px">
                        @foreach ($datos as $dato)
                            <tr>
                                <td rowspan="3" style="width:25%">
                                    @if (is_null($dato->image_profile)) 
                                        <img class="max-w-full h-auto rounded-full"
                                        src="{{url('img/users/avatar.png')}}" height="100"
                                        width="100" />    
                                    @else

                                        <img class="max-w-full h-auto rounded-full"
                                        src="{{ url('img/users/' . $dato->image_profile) }}" height="100"
                                        width="100" /> 
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>{{ $dato->name }}</td>
                            </tr>
                            <tr>
                                <td style=" opacity: 0.5">{{ $dato->date_publication }}</td>
                            </tr>
                        
                    </table>

                    <!--Opciones-->
                    <div style="text-align: right;" class="ml-12">
                        <div class="mt-2">

                            <!--Comprobemos los roles en primer lugar
                            
                                Admin: No le pertenece el post podrá borrar. Si le pertenece podrá borrarlo y editarlo
                                User: No le èrtenece no podrá hacer nada. Si es suyo editar y eliminar.
                            
                            -->
                            <!--Es Admin-->
                            @if (Auth::user()->role_id == 1) 
            
                
                            <!--El post le pertenece-->
                                    @if (Auth::user()->id == $dato->user_id)

                                

                                            <a href="{{route('post.edit', $dato->id)}}">
                                                <input type="submit"
                                                    class="mb-3 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                                    style="background-color: #a05a2c;" value="Editar">
                                            </a>

                                            <a href="{{route('post.destroy', $dato->id)}}">
                                                <input type="submit"
                                                    class="mb-3 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                                    style="background-color: #a05a2c;" value="Eliminar">
                                            </a>    
                               <!--No le pertenece-->             
                                    @else
                                            <a href="{{route('post.destroy', $dato->id)}}">
                                                <input type="submit"
                                                    class="mb-3 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                                    style="background-color: #a05a2c;" value="Eliminar">
                                            </a>      
                                    @endif


                            <!--No es admin-->
                            @else
                            <!--El post le pertenece-->
                                    @if (Auth::user()->id == $dato->user_id)

                                            <a href="{{route('post.edit', $dato->id)}}">
                                                <input type="submit"
                                                    class="mb-3 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                                    style="background-color: #a05a2c;" value="Editar">
                                            </a>

                                            <a href="{{route('post.destroy', $dato->id)}}">
                                                <input type="submit"
                                                    class="mb-3 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                                    style="background-color: #a05a2c;" value="Eliminar">
                                            </a> 
                                            
                                    <!--No le pertenece. No ha de mostrar ningun boton-->        

                                    @endif

                            @endif  
                            <a href="{{ url('dashboard/') }}">
                                <input type="button"
                                    class='inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 '
                                    style="background-color: #a05a2c; margin-left: 4px" value="Regresar">
                            </a>
                        </div>
                    </div>

                    <!--Imagen de portada-->
                    @if (isset($dato->image))
                        <div class=" mt-4 mb-4 flex flex-wrap justify-center ">
                            <img src="{{ url('img/posts/' . $dato->image) }}" height="400px" width="300px" />
                        </div>
                    @else
                        <div class=" mt-4 mb-4 bg-indigo-300 flex flex-wrap justify-center ">
                            <img class="object-cover" src={{ URL::asset('/img/bookpre.jpg') }}
                                style="height: 400px; width:400px;">
                        </div>
                    @endif

                    <!--Titulo, lugares donde comprar, descripcion, likes y comentarios-->
                    <div class="ml-12">
                        <div class="mt-2 text-center">
                            <p class="text-xl font-bold">{{ $dato->title }}</p>
                            <p class="text-lg font-semibold mt-1">Disponible en : {{ $dato->buy_on }}</p>
                        </div>
                        <p class="text-lg mt-4">{{ $dato->description }}</p>

                        <!--Bucle para los likes-->
                       
                            <p class="text-base mt-4" style="color: #5e3217">Likes ({{ $dato->contadorLikes }})</p>
                      

                        <!--Bucle para comentarios-->
                      
                            <p class="text-base mt-1" style="color: #5e3217">Comentarios
                                ({{ $dato->contadorComments }})
                            </p>
                        @endforeach
                    </div>
                    <!--Comentarios de forma temporal-->
                    <table class="overflow-hidden  mb-4" style="width:100%; height:100px;">
                        <tr>
                            <td>
                                <x-input style="background-color: #f7e5d8" class="block mt-1 w-full"></x-input>
                            </td>
                            <td><svg style="color: #5e3217;" class="h-6 w-6 text-yellow-500" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <line x1="22" y1="2" x2="11" y2="13" />
                                    <polygon points="22 2 15 22 11 13 2 9 22 2" />
                                </svg></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
