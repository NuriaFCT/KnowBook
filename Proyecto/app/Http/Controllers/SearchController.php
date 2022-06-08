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

            //$resultados=User::where('name', 'like', '%'.$buscarpor.'%');

            $resultados = User::where('name', 'like', '%'.$buscarpor.'%')->get();
            //$resultados->Where('name', 'like', '%'.$buscarpor.'%');
            //dd($resultados);

        }else{

            $resultados=Post::where('title', 'like', '%'.$buscarpor.'%')->get();

            //Con esta consulta sacaremos el numero de likes por cada post
           /* $likes = DB::table('likes')
            ->select(DB::raw('count(likes.post_id) as contador'))
            ->where('likes.post_id', '=', 34)  //hay que cambiar el 34 igual que arriba
            ->get();

            //Con esta consulta sacaremos el numero de comentarios de cada post
            $comments = DB::table('comments')
            ->select(DB::raw('count(comments.post_id) as contadorComentarios'))
            ->where('comments.post_id', '=', 34)  //hay que cambiar el 34 igual que arriba
            ->get();*/
        }
        //dd($resultados);
       //likes y commetn quitados
        return view('search.index', ["resultados"=>$resultados, "buscarpor"=>$buscarpor, "categoria"=>$categoria]);
        
    }

    public function show(){
    
        return view ('search.buscador');

    }

}
