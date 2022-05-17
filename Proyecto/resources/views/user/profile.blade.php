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
                   Perfil de usuario logueado
                    <!--Comprobamos que este logueado--->
                    @if(auth()->check())
                              <!--Tanto admin como usuario podran editarase el perfil pero no seguirse asi mismo-->
                              @if(Auth::user()->id == $user->id ) 
                                <!--Editar. Corresponde a su perfil-->
                                <!-- <a href="{{--url('/user/'.$user->id.'/edit')--}}">-->
                                <a href="{{route('config')}}">
                                    <input type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" style="background-color: #a05a2c;" value="Editar">
                                </a>

                              @else 
                              <!--Follow. Perfil de otro usuario.-->
                              @endif
                    @endif   
                    
                    <!--Si es el logueado, admin, tendra la posibilidad de borrarlo-->
                    @if(auth()->check())
                    <!--Admin-->
                      @if(Auth::user()->role_id == 1) 
                       <!--Borrar-->
                       <form action="{{ url('/users/'.$user->id) }}" method="post">  
                            @csrf <!--lo pide laravel-->
                            {{ method_field('DELETE')}}<!--CAMBIO A DELETE PUESTO EL QUE DESTROY ACEPTA ESTE-->
                            <input type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" style="background-color: #a05a2c;" onclick="return confirm('¿Deseas borrar?')" value="Borrar">
                        </form>                                   
                       @endif  
                     @endif   

                </div>
            </div>
        </div>
    </div>
</x-app-layout>