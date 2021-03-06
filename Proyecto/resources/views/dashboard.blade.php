<!--DESCRIPCION: Vista Home donde se visualizara los post de los seguidores de la cuenta logueada-->

<x-app-layout>
    <x-slot name="header">

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-message-status class="mb-4" :status="session('status')" />

                    <!--Hay posts porque se sigue a alguien-->
                    @if (count($posts) > 0)

                        <!--Primer bucle que recorre las publicaciones de los seguidores-->
                        @foreach ($posts as $post)
                            <table class="rounded overflow-hidden shadow-lg mb-4"
                                style="background-color: #f7e5d8; width:100%; height:300px">
                                <tr>
                                    <td rowspan="3" style="  width: 20%"><img
                                            src="{{ url('img/posts/' . $post->image) }}" height="100" width="80%"
                                            class="img-thumbnail rounded float-left mr-3" /></td>
                                 
                                    <td colspan="3"><b>{{ $post->title }}</b></td>
                                    <td style="vertical-align: top">
                                        <a href="{{ route('posts.show', $post->id) }}">
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

                                <!--El numero de likes y dar likes-->
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

                                    <!--El numero de comentarios por post y ver la lista de comentarios-->

                                    <td>
                                        <p style="text-align:right">{{ $post->comentarios }}</p>
                                    </td>


                                    <td>
                                        <a href="{{ route('posts.createComment', $post->id) }}">
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

                        <!-- No hay posts porque no se sigue nadie-->
                    @else
                        <div class="flex flex-wrap justify-center">
                            <div class="w-6/12 sm:w-4/12 px-4">
                                <img src="{{ url('img/vectorLibroBW.png') }}" alt="VectorLibro"
                                    class="shadow rounded max-w-full h-auto align-middle border-none"
                                    style="opacity: 0.4" />
                            </div>
                        </div>

                        <div class="h-screen flex flex-col items-center justify-center border-none">
                            <p class="text-xl mb-3 ">
                                ??Comienza a <strong>seguir</strong> a otras cuentas para visualizar su contenido en esta
                                pesta??a!
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>




</x-app-layout>
