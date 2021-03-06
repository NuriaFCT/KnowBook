<!--DESCRIPCION: Vista de las alertas.
    Debido a la dificultad no se ha filtrado, es decir, no muestra unicamente la del usuario logueado
    sino toda actividad de la app-->
<x-app-layout>
    <x-slot name="header">

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                   

                    @foreach ($alerts as $alert)

                        <table class="rounded overflow-hidden shadow-lg mb-4" style="background-color: #f7e5d8; border: 2px solid black; width:100%; height:100px">
                            <tr>
                                <!--Imagen en relacion a la accion que se provoque. La idea inical era sacar los datos del usuario-->

                                    <td style="width:10%">
                                        @if ($alert->type=="Like")
                                            <div class="bg-indigo-300 flex flex-wrap justify-center"> <!--6.77 gamma-->
                                                <img class="max-w-full h-auto rounded"  src="{{url('img/alerts/like.png') }}" style="height: 100px; width:100px;">
                                            </div> 
                                        @endif

                                        @if ($alert->type=="Follow")
                                            <div class="bg-indigo-300 flex flex-wrap justify-center">
                                                <img class="max-w-full h-auto rounded"  src="{{url('img/alerts/follow.png') }}" style="height: 100px; width:100px;">
                                            </div>
                                        @endif
                                        
                                        @if ($alert->type=="Comment")
                                            <div class="bg-indigo-300 flex flex-wrap justify-center">
                                                <img class="max-w-full h-auto rounded" src= "{{url('img/alerts/comment.png') }}" style="height: 100px; width:100px;">
                                            </div>
                                        @endif
                                    </td>
                                <!--Accion realizada-->
                                <td >
                                    {{$alert->message}}
                                </td>
                                <!--Icon que ilustra la reaccion realizada por otro usuario-->
                                <td style="width:10%">
                                    @if ($alert->type=="Like")
                                        <svg style="color: #5e3217" class="h-8 w-8 text-red-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                        </svg>
                                    @endif
                                    @if ($alert->type=="Follow")
                                      <svg style="color: #5e3217" class="h-8 w-8 text-green-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                      </svg>
                                    @endif
                                    @if ($alert->type=="Comment")
                                        <svg style="color: #5e3217" class="h-8 w-8 text-yellow-500"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  
                                            <path stroke="none" d="M0 0h24v24H0z"/>  
                                            <path d="M3 20l1.3 -3.9a9 8 0 1 1 3.4 2.9l-4.7 1" />  <line x1="12" y1="12" x2="12" y2="12.01" />  
                                            <line x1="8" y1="12" x2="8" y2="12.01" />  <line x1="16" y1="12" x2="16" y2="12.01" />
                                        </svg>
                                    @endif

                                </td>
                            </tr>
                        </table>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</x-app-layout>



