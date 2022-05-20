<!--DESCRIPCION: Vista Home donde se visualizara los post de los seguidoresd de la cuenta logueada-->

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
                    <x-message-status class="mb-4" :status="session('status')" /> 
                   

                    @foreach ($posts as $post)
                            <table class="rounded overflow-hidden shadow-lg mb-4" style="background-color: #f7e5d8; border: 2px solid black; width:100%; height:300px">
                                <tr style="border: 2px solid black;">
                                    <td rowspan="3" style="border: 2px solid black;">Imagen</td> <!--por el momento-->
                                    <td colspan="3" style="border: 2px solid black;"><b>{{$post->title}}</b></td>
                                    <td style="vertical-align: top">     
                                     <a href="{{route('posts.show', ['post'=>$post->id])}}">   
                                        <svg style="color: #5e3217" class="h-8 w-8 text-yellow-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                     </a>
                                    </td>                                         
                                </tr>
                                <tr style="border: 2px solid black;">
                                    <td colspan="4" style="border: 2px solid black;">{{$post->description}}</td>
                                </tr>   

                                <tr style="border: 2px solid black;">
                                    <td style="border: 2px solid black;">
                                        <p style="text-align:right">like</p>
                                    </td>
                                    <td>
                                        <svg style="color: #5e3217" class="h-8 w-8 text-red-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                        </svg>
                                    </td>
                                    <td style="border: 2px solid black;">
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
