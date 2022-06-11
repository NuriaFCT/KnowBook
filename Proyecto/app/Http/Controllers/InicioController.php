<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\POST;
use stdClass;

class InicioController extends Controller
{

    /**
     * Funcion que retorna a la vista los post de tus seguidos
     * 
     * @return view dashboard (inicio) con toda la informacion
     */
    public function index(){


    $id = Auth::user()->id;


    //Sacar los id de las personas que sigo, mis seguidos y guardarlo en un array
    $id_user_follower = DB::table('followers')
    ->select('followers.id_user_follower')
    ->join('users', 'users.id', '=', 'followers.user_id')
    ->where('users.id', '=', $id)
    ->get();

    $id= array($id_user_follower);
    
    $array_ids=array();

    foreach($id[0] as $id_user){
        $array_ids[]=$id_user->id_user_follower;
    }
    
    //Saco todos los post y luego filtro
    $posts= Post::all();

    $post_filtrado= new stdClass;
    $post_filtrado->items=array();
    foreach($posts as $post){
        if (in_array($post->user_id,$array_ids)){
            $post_filtrado->items[]=$post;
        }
        
    }

    return view('dashboard', ["posts" => $post_filtrado->items]);

    }
}  