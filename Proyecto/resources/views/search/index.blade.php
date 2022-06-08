<!--DESCRIPCION: Vista de busqueda. En ella habra un campo y dos categorias a elegir para buscar
En principio no mostrará nada, luego si con una sentenica sql-->
<x-app-layout>
    <x-slot name="header">
        <!--
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- __('KNOWBOOK') --}}
        </h2>-->
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="bg-white border-b border-gray-200 overflow-auto ">
                    <x-message-status class="mb-4" :status="session('status')" />

                    <form method="GET" action="{{ route('searchs.index') }}" enctype="multipart/form-data">
                        <!--Buscador--->
                        <table class="rounded overflow-hidden shadow-lg mb-4" style="width: 100%">
                            <tr>
                                <td>

                                    <!--Lista despeglabe si es usuario o blog-->
                                    <select name="categoria" id="categoria"
                                        class="form-select appearance-none block w-full py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                        aria-label="Default select example">
                                        <option selected value="usuario" name="categoria" id="usuario">Usuario</option>
                                        <option value="recomendacion" name="categoria" id="recomendacion">Recomendación
                                        </option>
                                    </select>
                                </td>
                                <td>
                                    <!--Buscar por name de cuenta o titulo de post-->
                                    <x-input id="buscarpor" type="search" name="buscarpor"
                                        value="{{ isset($buscarpor) ? $buscarpor : '' }}"
                                        placeholder="Inserte nombre de una cuenta o titulo de un post"
                                        style="width: 400px" />

                                </td>
                                <td>
                                    <a>
                                        <input type="submit"
                                            class="mb-3 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                            style="background-color: #a05a2c;" value="Buscar">
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </form>

                    <!--Categoria es igual a usuario se mostrará de una forma-->
                    @if ($categoria == 'usuario')

                        <!--Si hay registros-->
                        @if (count($resultados) > 0)

                            @foreach ($resultados as $user)
                                <table class="rounded overflow-hidden shadow-lg mb-4"
                                    style="background-color: #f7e5d8; width:100%; height:100px">
                                    <tr>
                                        <td style="width:20%">
                                            @if (isset($user->image_profile))
                                                <div class="bg-indigo-300 flex flex-wrap justify-center">
                                                    <img class="max-w-full h-auto rounded-full"
                                                        src="{{ url('img/users/' . $user->image_profile) }}"
                                                        style="height: 100px; width:100px;">
                                                </div>
                                            @else
                                                <div class="bg-indigo-300 flex flex-wrap justify-center">
                                                    <img class="max-w-full h-auto rounded-full"
                                                        src="{{url('img/users/avatar.png')}}" style=" height: 100px;
                                                        width:100px;">
                                                </div>
                                            @endif
                                        </td>
                                        <!--por el momento-->
                                        <td style="width: 60%"><b>{{ $user->name }}</b></td>
                                        <td style="width:20%">
                                            <a href="{{ route('users.profile', $user->id)}}">
                                                <svg style="color: #5e3217" class="h-8 w-8 text-yellow-500" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            @endforeach

                            <!--Si no lo hay-->
                        @else
                            <h1><b>¡Ups! </b>No se han encontrado resultados para la búsqueda de usuarios</h1>

                        @endif

                        <!--Si es post se mostrará de otra forma-->
                    @else
                        <!--Si hay registros-->
                        @if (count($resultados) > 0)

                            @foreach ($resultados as $post)
                                <table class="rounded overflow-hidden shadow-lg mb-4"
                                    style="background-color: #f7e5d8; width:100%; height:300px">
                                    <tr>
                                        <td rowspan="3" style="  width: 20%">       
                                            
                                                <img src="{{ url('img/posts/' . $post->image) }}" height="100" width="70%"
                                                    class="img-thumbnail rounded float-left mr-3" />

                                        </td>
                                        <!--por el momento-->

                                        <td colspan="3"><b>{{ $post->title }}</b></td>
                                        <td style="vertical-align: top">
                                            <a href="{{ route('posts.show', $post->id) }}">
                                                <svg style="color: #5e3217" class="h-8 w-8 text-yellow-500" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">{{ $post->description }}</td>
                                    </tr>

                                    <tr>
                                        <!--Contador de likes-->
                                        {{-- @foreach ($likes as $like)            
                                        <td >
                                            <p style="text-align:right">{{$like->contador}}</p>
                                        </td>
                                    @endforeach --}}
                                        <td>
                                            <svg style="color: #5e3217" class="h-8 w-8 text-red-500" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            </svg>
                                        </td>

                                        <!--Contador de comentarios-->
                                        {{-- @foreach ($comments as $comment)
                                        <td >
                                            <p style="text-align:right">{{$comment->contadorComentarios}}</p>
                                        </td>
                                    @endforeach --}}
                                        <td>
                                            <svg style="color: #5e3217" class="h-8 w-8 text-yellow-500" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" />
                                                <path d="M3 20l1.3 -3.9a9 8 0 1 1 3.4 2.9l-4.7 1" />
                                                <line x1="12" y1="12" x2="12" y2="12.01" />
                                                <line x1="8" y1="12" x2="8" y2="12.01" />
                                                <line x1="16" y1="12" x2="16" y2="12.01" />
                                            </svg>
                                        </td>
                                    </tr>
                                </table>
                            @endforeach

                            <!--Si no lo hay-->
                        @else
                            <h1><b>¡Ups! </b>No se han encontrado resultados para la búsqueda de publicaciones</h1>

                        @endif


                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
