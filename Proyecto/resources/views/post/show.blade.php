<!--DESCRIPCION: Vista en detalle o individual de los post. Se accedera a los comentarios y al contenido entero-->

<x-app-layout>
    <x-slot name="header">
        <!--
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{--__('KNOWBOOK')--}}
        </h2>-->
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                   
                    
                    <!--Autor: Foto, fecha y nickname-->
                    <table class=" overflow-hidden mb-4" style="width:100%; height:100px; margin-left: 50px">
                        <tr >
                            <td rowspan="3" style="width:25%">Perfil de autor</td>   

                        </tr>  
                        <tr >
                            <td >Autor</td>
                        </tr> 
                        <tr >
                            <td style=" opacity: 0.5">{{$post->date_publication}}</td>
                        </tr>    
                    </table>  


                    <!--Opciones-->
                    <div style="text-align: right;" class="ml-12">
                        <div class="mt-2">
                            <!--Editar post si corresponde al usuario logueado-->
                            <!--Si el usuario autenticado corresponde al id del post, puede editarlo-->
                            {{--@if(auth()->check())
                                @if(Auth::user()->id == $post->user_id) --}}
                                    <a href="{{url('/posts/'.$post->id.'/edit')}}">
                                        <input type="submit" class="mb-3 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" style="background-color: #a05a2c;" value="Editar">
                                    </a>
                                {{--@endif
                            @endif   --}}

                             <!--Si es el logueado, admin, tendra la posibilidad de borrarlo-->
                                    {{--@if(auth()->check())
                                    <!--Admin-->
                                        @if(Auth::user()->role_id == 1) --}}
                                                <!--Borrar-->
                                                <form action="{{ url('/posts/'.$post->id) }}" method="post">  
                                                    @csrf <!--lo pide laravel-->
                                                    {{ method_field('DELETE')}}<!--CAMBIO A DELETE PUESTO EL QUE DESTROY ACEPTA ESTE-->
                                                    <input type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" style="background-color: #a05a2c;" onclick="return confirm('¿Deseas borrar?')" value="Borrar">
                                                </form>                                   
                                           {{-- @endif  
                                    @endif  --}} 
                        </div>
                    </div>

                    
                    <!--Imagen de portada-->
                    @if (isset($post->image))
                                Tiene valor en el campo img. Habria que sacar y mostrar.
                                ANOTO QUE EDITAR Y BORRAR NO VA
                    @else
                
                    <div class=" mt-4 mb-4 bg-indigo-300 flex flex-wrap justify-center ">
                        <img class="object-cover" src={{URL::asset('/img/bookpre.jpg')}} style="height: 400px; width:400px;">
                    </div>
                        
                    @endif
                    <!--Titulo, lugares donde comprar, descripcion, likes y comentarios-->
                    <div class="ml-12">
                        <div class="mt-2 text-center">
                            <p class="text-xl font-bold">{{$post->title}}</p>
                            <p class="text-lg font-semibold mt-1">Disponible en : {{$post->buy_on}}</p> 
                        </div>
                        <p class="text-lg mt-4">{{$post->description}}</p>
                        <p class="text-base mt-4" style="color: #5e3217">Likes (xx)</p>
                        <p class="text-base mt-1" style="color: #5e3217">Comentarios (xx)</p>      
                    </div>

                    <!--Comentarios de forma temporal-->
                    <table class="overflow-hidden  mb-4" style="width:100%; height:100px;">
                        <tr>
                            <td><x-input style="background-color: #f7e5d8" class="block mt-1 w-full"></x-input></td>
                            <td><svg style="color: #5e3217;" class="h-6 w-6 text-yellow-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <line x1="22" y1="2" x2="11" y2="13" />  <polygon points="22 2 15 22 11 13 2 9 22 2" /></svg></td>
                        </tr>

                    </table>    

                </div>
            </div>
        </div>
    </div>
</x-app-layout>