<!--DESCRIPCION: Vista del perfil. Se visualizara los datos de la cuenta asi como sus post
Si es usuario logueado, podra editarse-->

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
                   

                    <table class=" overflow-hidden  mb-4" style="width:100%; height: 300px">
                        <!--Información del autor: Foto, name, etc-->
                        <tr>
                            <td rowspan="3" style="  width: 20%">Imagen de perfil</td>
                        </tr>   
                        <!--Numero de post, seguidores y seguidos-->
                        <tr class="font-bold" style=" text-align: center; height: 40%">
                            <td >XX</td>
                            <td >XX</td>
                            <td >XX</td>
                        </tr>
                        <!--Texto-->
                        <tr style="text-align: center; height: 15%">
                            <td>Publicaciones</td>
                            <td>Seguidores</td>
                            <td>Seguidos</td>
                        </tr>
                        <!--Name-->
                        <tr class="font-bold" style="height: 15%">
                            <td colspan="3">{{$user->name}}</td>
                        </tr>
                        <!--Bio-->
                        <tr style="height: 30%">
                            <td colspan="3">{{$user->biography}}</td>
                        </tr>
                    </table>

                        <!--Opciones-->
                    <table class="overflow-hidden  mb-4" style="text-align:center; width:100%; height: 50px">

                        <tr>

                            <!--Si el usuario es admin: Seguir y eliminar o editar-->
                            @if (Auth::user()->id == 1 )

                                <!--Si el perfil es suyo, podrá editarlo--->
                                @if (Auth::user()->id == $user->id)
                                    <!--Editar-->
                                    <td>
                                        <a href="{{route('config')}}">
                                            <input type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" style="background-color: #a05a2c;" value="Editar">
                                        </a>
                                    </td>

                                <!-- No es su perfil, podra seguirlo o borrarlo-->
                                @else
                                    <!--Seguir-->
                                    <td>
                                       <x-button> {{ __('Seguir') }}</x-button>
                                    </td>
                                    <td>
                                        <form action="{{ url('/users/'.$user->id) }}" method="post">  
                                            @csrf <!--lo pide laravel-->
                                            {{ method_field('DELETE')}}<!--CAMBIO A DELETE PUESTO EL QUE DESTROY ACEPTA ESTE-->
                                            <input type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" style="background-color: #a05a2c;" onclick="return confirm('¿Deseas borrar?')" value="Borrar">
                                        </form>   
                                    </td>     
                                @endif <!--Perfil de quien es. Admin-->
                            @else

                                <!--Si el perfil es suyo, podrá editarlo--->
                                @if (Auth::user()->id == $user->id)
                                    <!--Editar-->
                                    <td>
                                        <a href="{{route('config')}}">
                                            <input type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" style="background-color: #a05a2c;" value="Editar">
                                        </a>
                                    </td>
                                  <!-- No es su perfil, podra seguirlo o borrarlo-->
                                @else
                                  <!--Seguir-->
                                  <td style=" border: 2px black solid;">
                                     <x-button> {{ __('Seguir') }}</x-button>
                                  </td>
                                @endif    <!--Perfil de quien es. User-->
                            @endif<!--Rol del usuario logueado-->
                        </tr>
                    </table>     
                    
                     
                    <!--Publicaciones del usuario-->  
                     @foreach ($posts as $post)
                     <table class="rounded overflow-hidden shadow-lg mb-4" style="background-color: #f7e5d8; width:100%; height:200px">
                         <tr>
                             <td rowspan="3" >Imagen</td> <!--por el momento-->
                             <td colspan="3"><b>{{$post->title}}</b></td>
                             <td style="vertical-align: top">     
                              <a href="{{route('posts.show', ['post'=>$post->id])}}">   
                                 <svg style="color: #5e3217" class="h-8 w-8 text-yellow-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                 </svg>
                              </a>
                             </td>                                         
                         </tr>
                         <tr >
                             <td colspan="4">{{$post->description}}</td>
                         </tr>   

                         <tr >
                             <td >
                                 <p style="text-align:right">like</p>
                             </td>
                             <td>
                                 <svg style="color: #5e3217" class="h-8 w-8 text-red-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                 </svg>
                             </td>
                             <td >
                                 <p style="text-align:right">comment</p>
                             </td>
                             <td>
                                 <svg style="color: #5e3217" class="h-8 w-8 text-yellow-500"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M3 20l1.3 -3.9a9 8 0 1 1 3.4 2.9l-4.7 1" />  <line x1="12" y1="12" x2="12" y2="12.01" />  <line x1="8" y1="12" x2="8" y2="12.01" />  <line x1="16" y1="12" x2="16" y2="12.01" /></svg>
                             </td>
                         </tr>    
                     </table>   
             @endforeach


                </div>
            </div>
        </div>
    </div>
</x-app-layout>