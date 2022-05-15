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
                    Vista individual.
                   
                    <!--Editar post si corresponde al usuario logueado-->
                    <!--Si el usuario autenticado corresponde al id del post, puede editarlo-->
                    @if(auth()->check())
                        @if(Auth::user()->id == $post->user_id) 
                        <a href="{{url('/posts/'.$post->id.'/edit')}}">
                            <input type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" style="background-color: #a05a2c;" value="Editar">
                        </a>
                        @endif
                    @endif    

                     <!--Si es el logueado, admin, tendra la posibilidad de borrarlo-->
                     @if(auth()->check())
                     <!--Admin-->
                       @if(Auth::user()->role_id == 1) 
                        <!--Borrar-->
                        <form action="{{ url('/posts/'.$post->id) }}" method="post">  
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