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
                                style="background-color: #f7e5d8; width:100%; height:100px">
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
                                    <!--Eliminar comentario-->
                                    <!--Si eres admin puedes borrar tanto siendo tuyo como sino y fuera de tus posts-->
                                  @if(Auth::user()->role_id==1)  
                                    <td style=" width:10%;" >
                                        <a href="{{ route('posts.destroyComments', $dato->id) }}"> 
                                            <svg style="color: #5e3217"  width="18"  height="18" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </a>    
                                    </td>
                                  <!--Si eres usuario normal, solo aquellos que sean tuyos o bien esten en tus posts-->
                                  @else
                                   
                                        @if($dato->user_id==Auth::user()->id || Auth::user()->id==$dato->autor)

                                            <td style=" width:10%;" >
                                                <a href="{{ route('posts.destroyComments', $dato->id) }}"> 
                                                    <svg style="color: #5e3217"  width="18"  height="18" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                    </svg>
                                                </a>    
                                            </td>

                                        @endif
                                  @endif  

                                    <!--Editar comentario-->
                                    <!--Solo se podran editar los comentarios que nos pertenezca tanto admin como usuario normal-->
                                    @if($dato->user_id==Auth::user()->id)
                                        <td style="width:10%;" >
                                            <a href="{{ route('posts.editComment', $dato->id) }}"> 
                                                <svg  style="color: #5e3217" width="24"  height="24"  viewBox="0 0 24 24"  xmlns="http://www.w3.org/2000/svg"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <path d="M12 20h9" />  <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z" /></svg>
                                            <a>
                                        </td>
                                    @endif    



                                    <tr>
                                    <!--Texto dejado-->    
                                        <td colspan="3">{{ $dato->text }}</td>
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
