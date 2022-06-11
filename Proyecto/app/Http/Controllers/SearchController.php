<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    /**
     * Funcion que retorna la vista de busqueda con sus campos y categorias
     * @param request recibe los datos de los campos de form de search
     * @return search.index retorna a una segunda vista igual creada arrojando los resultados
     */
    public function index(Request $request){

        //Se recoge la informacion de los campos
        $buscarpor=$request->get('buscarpor');
        $categoria=$request->get('categoria');

        //Con un if, se establece los resultados posibles y se almacena la consulta devuelta
        //Usuario
        if(isset($categoria) && $categoria=='usuario'){

            $resultados = User::where('name', 'like', '%'.$buscarpor.'%')->get();
            
        //Post
        }else{

            $resultados=Post::where('title', 'like', '%'.$buscarpor.'%')->get();

        }
        
        return view('search.index', ["resultados"=>$resultados, "buscarpor"=>$buscarpor, "categoria"=>$categoria]);
        
    }



    /**
     * Funcion que devuelve la vista de search buscador 
     * 
     * @return search.buscador solo contiene el formulario para buscar el contenido
     */
    public function show(){
    
        return view ('search.buscador');

    }

}
