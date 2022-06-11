<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{

    /**
     * Funcion que retorna la vista de busqueda con sus campos y categorias
     * 
     * @return index
     */
    public function index(Request $request){

        $buscarpor=$request->get('buscarpor');
        $categoria=$request->get('categoria');

        if(isset($categoria) && $categoria=='usuario'){


            $resultados = User::where('name', 'like', '%'.$buscarpor.'%')->get();
            

        }else{

            $resultados=Post::where('title', 'like', '%'.$buscarpor.'%')->get();

        }
        
        return view('search.index', ["resultados"=>$resultados, "buscarpor"=>$buscarpor, "categoria"=>$categoria]);
        
    }

    public function show(){
    
        return view ('search.buscador');

    }

}
