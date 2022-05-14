<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

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

            $resultados=User::where('name', 'like', '%'.$buscarpor.'%');

        }else{

            $resultados=Post::where('title', 'like', '%'.$buscarpor.'%');
        }

        return view('search.index', compact('resultados', 'buscarpor', 'categoria'));
    }
}
