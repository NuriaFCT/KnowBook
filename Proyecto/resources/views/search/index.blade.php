
<!--DESCRIPCION: Vista de busqueda. En ella habra un campo y dos categorias a elegir para buscar
En principio no mostrará nada, luego si con una sentenica sql-->
<x-app-layout>
    <x-slot name="header">
        <!--
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{--__('KNOWBOOK')--}}
        </h2>-->
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="bg-white border-b border-gray-200 overflow-auto ">
                    <x-message-status class="mb-4" :status="session('status')" />
                    <div class="flex items-center">
                      <div class="justify-end" style="margin-left: 50px">
                        <form>  
                             <!--BUSCAR POR CAMPO-->
                            <x-input id="buscarpor"  type="search" name="buscarpor" value="{{isset($buscarpor)?$buscarpor:''}}" placeholder="Inserte nombre de una cuenta o titulo de un post" style="width: 400px"/>
                             
                            <!--Segun que: Post o recomendacion. Saldara una por defecto en caso de que no se señale-->  
                            <select name="categoria" id="categoria" class="form-select appearance-none block w-full py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example">
                                <option selected value="usuario" name="categoria" id="usuario">Usuario</option>
                                <option value="recomendacion" name="categoria" id="recomendacion">Recomendación</option>
                            </select> 
                            
                            <x-button class="ml-4">{{ __('Buscar') }}</x-button>

                        </form>   
                       </div>  
                    <!--Tipo si hay varios resultados que salga, sino texto-->

                       
                </div>
                


                
        </div>
    </div>
</x-app-layout>  
                   

