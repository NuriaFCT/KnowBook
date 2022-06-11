<!--DESCRIPCION: Vista del perfil. Se visualizara los datos de la cuenta asi como sus post
Si es usuario logueado, podra editarse-->
<x-app-layout>
    <x-slot name="header">


        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Más información sobre la cuenta') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">


                    <table class=" overflow-hidden  mb-4" style="width:100%; height: 300px">
                        <!--Información del autor: Foto, name, etc-->
                        <tr>
                            <td rowspan="3" style="  width: 20%">

                                @if (is_null($user->image_profile))
                                    <img class="max-w-full h-auto rounded-full" src="{{ url('img/users/avatar.png') }}"
                                        height="300" width="300" />
                                @else
                                    <img class="max-w-full h-auto rounded-full"
                                        src="{{ url('img/users/' . $user->image_profile) }}" height="300"
                                        width="300" />
                                @endif


                            </td>
                        </tr>
                        <!--Numero de post, seguidores y seguidos-->
                        <tr class="font-bold" style=" text-align: center; height: 40%; font-size: 35px">

                            @foreach ($numposts as $numpost)
                                <td>{{ $numpost->contadorPosts }}</td>
                            @endforeach

                            @foreach ($seguidores as $seguidor)
                                <td>{{ $seguidor->contadorSeguidores }}</td>
                            @endforeach

                            @foreach ($siguiendo as $seguido)
                                <td>{{ $seguido->contadorSeguidos }}</td>
                            @endforeach

                        </tr>
                        <!--Texto-->
                        <tr style="text-align: center; height: 15%">
                            <td>Publicaciones</td>
                            <td>Seguidores</td>
                            <td>Seguidos</td>
                        </tr>
                        <!--Name-->
                        <tr class="font-bold" style="height: 15%">
                            <td colspan="3">{{ $user->name }}</td>
                        </tr>
                        <!--Bio-->
                        <tr style="height: 30%">
                            <td colspan="3">{{ $user->biography }}</td>
                        </tr>
                    </table>

                    <!--Opciones-->
                    <table class="overflow-hidden  mb-4" style="text-align:center; width:100%; height: 50px">

                        <tr>

                            <!--Si el usuario es admin: Seguir y eliminar o editar y eliminar-->
                            @if (Auth::user()->role_id == 1)

                                <!--Si el perfil es suyo, podrá editarlo y eliminarlos--->
                                @if (Auth::user()->id == $user->id)
                                    <!--Editar-->
                                    <td>
                                        <a href="{{ route('config') }}">
                                            <input type="submit"
                                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                                style="background-color: #a05a2c;" value="Editar">
                                        </a>
                                    </td>

                                    <!--Eliminar la cuenta-->
                                    <td>
                                        <a href="{{ route('user.destroy', $user->id) }}">
                                            <input type="submit"
                                                class="mb-3 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                                style="background-color: #a05a2c;" value="Eliminar">
                                        </a>
                                    </td>

                                    <!-- No es su perfil, podra seguirlo o borrarlo-->
                                @else
                                    <!--Seguir-->
                                    <td>
                                        <x-button> {{ __('Seguir') }}</x-button>
                                    </td>
                                    <!-- Eliminar -->
                                    <td>
                                        <a href="{{ route('user.destroy', $user->id) }}">
                                            <input type="submit"
                                                class="mb-3 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                                style="background-color: #a05a2c;" value="Eliminar">
                                        </a>
                                    </td>
                                @endif
                                <!--Perfil de quien es. Admin-->
                                <!--No es admin-->
                            @else
                                <!--Si el perfil es suyo, podrá editarlo y eliminarlo--->
                                @if (Auth::user()->id == $user->id)
                                    <!--Editar-->
                                    <td>
                                        <a href="{{ route('config') }}">
                                            <input type="submit"
                                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                                style="background-color: #a05a2c;" value="Editar">
                                        </a>
                                    </td>
                                    <!--Eliminar la cuenta-->
                                    <td>
                                        <a href="{{ route('user.destroy', $user->id) }}">
                                            <input type="submit"
                                                class="mb-3 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                                style="background-color: #a05a2c;" value="Eliminar">
                                        </a>
                                    </td>
                                    <!-- No es su perfil, podra seguirlo-->
                                @else
                                    <!--Seguir-->
                                    <td>

                                        @if ($s == 'siguiendo')
                                            <a href="{{ route('user.unfollow', $user->id) }}"
                                                class='inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150'
                                                style='background-color: white; color:#a05a2c'>
                                                Dejar de seguir
                                            </a>
                                        @else
                                            <a href="{{ route('user.follow', $user->id) }}"
                                                class='inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150'
                                                style='background-color: #a05a2c;'>
                                                Seguir
                                            </a>
                                        @endif

                                    </td>
                                @endif
                                <!--Perfil de quien es. User-->
                            @endif
                            <!--Rol del usuario logueado-->
                        </tr>
                    </table>


                    <!--Publicaciones del usuario-->

                    <!--Si tiene-->

                    @if (count($posts) > 0)

                        @foreach ($posts as $post)
                            <table class="rounded overflow-hidden shadow-lg mb-4"
                                style="background-color: #f7e5d8; width:100%; height:200px">
                                <tr>
                                    <td rowspan="3" style="width: 20%"><img
                                            src="{{ url('img/posts/' . $post->image) }}" height="100" width="70%" />
                                    </td>
                                    <!--por el momento-->
                                    <td colspan="3"><b>{{ $post->title }}</b></td>
                                    <td style="vertical-align: top">
                                        <a href="{{ route('posts.show', ['post' => $post->id]) }}">
                                            <svg style="color: #5e3217" class="h-8 w-8 text-yellow-500" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">{{ $post->description }}</td>
                                </tr>

                                <tr>
                                    <td>


                                        <p style="text-align:right">{{ $post->likes }}</p>


                                    </td>

                                    <td>
                                        <a href="{{ route('posts.like', $post->id) }}">
                                            <svg style="color: #5e3217" class="h-8 w-8 text-red-500" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            </svg>
                                        </a>
                                    </td>

                                    <!--Tercer bucle para mostrar el numero de comentarios por post-->

                                    <td>
                                        <p style="text-align:right">{{ $post->comentarios }}</p>
                                    </td>


                                    <td>
                                        <a href="{{ route('posts.comentarios', $post->id) }}">
                                            <svg style="color: #5e3217" class="h-8 w-8 text-yellow-500" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" />
                                                <path d="M3 20l1.3 -3.9a9 8 0 1 1 3.4 2.9l-4.7 1" />
                                                <line x1="12" y1="12" x2="12" y2="12.01" />
                                                <line x1="8" y1="12" x2="8" y2="12.01" />
                                                <line x1="16" y1="12" x2="16" y2="12.01" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        @endforeach

                        <!--Si no hay posts-->
                    @else
                        <div class="flex flex-wrap justify-center">
                            <div class="w-6/12 sm:w-4/12 px-4">
                                <img src="{{ url('img/vectorLibroBW.png') }}" alt="VectorLibro"
                                    class="shadow rounded max-w-full h-auto align-middle border-none"
                                    style="opacity: 0.4" />
                            </div>
                        </div>
                        <!--Es mio el perfil-->
                        @if (Auth::user()->id == $user->id)
                            <div class="h-screen flex flex-col items-center justify-center border-none">
                                <p class="text-xl mb-3 ">
                                    <strong>¡Sube tu primera recomendación!</strong> El contenido se visualizará aquí
                                </p>
                            </div>
                            <!--No lo es-->
                        @else
                            <div class="h-screen flex flex-col items-center justify-center border-none">
                                <p class="text-xl mb-3 ">
                                    <strong>¡Oh, oh!</strong> Este usuario no ha compartido nada actualmente
                                </p>
                            </div>
                        @endif

                    @endif


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
