<!--DESCRIPCION: Vista de busqueda. En ella habra un campo y dos categorias a elegir para buscar
En principio no mostrará nada, luego si con una sentenica sql-->
<x-app-layout>
    <x-slot name="header">
       
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="bg-white border-b border-gray-200 overflow-auto ">
                    <x-message-status class="mb-4" :status="session('status')" />

                    <form method="GET" action="{{route('searchs.index')}}" enctype="multipart/form-data"> 
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
                                    <!--Btn enviar-->
                                    <a>
                                        <input type="submit"
                                            class="mb-3 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                            style="background-color: #a05a2c;" value="Buscar">
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 