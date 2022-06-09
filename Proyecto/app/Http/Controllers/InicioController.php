<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\POST;
use stdClass;

class InicioController extends Controller
{

    /**
     * 
     * 
     * 
     * @return index
     */
    public function index(){


    $id = Auth::user()->id;

    //dd($id);

    //Sacar los id de las personas que sigo, mis seguidos
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
    
    //dd($id[0][1]->id_user_follower);

    $posts= Post::all();

    $i=1;

    /*foreach($id[0] as $id_user){

        print("IT ".$i. ":");
        print_r($id_user->id_user_follower);
        $posts=$posts->where('user_id',null, $id_user->id_user_follower);
        $i++;
        break;       
    }*/

    $post_filtrado= new stdClass;
    $post_filtrado->items=array();
    foreach($posts as $post){
        if (in_array($post->user_id,$array_ids)){
            $post_filtrado->items[]=$post;
        }
        
    }

    //dd($posts);
    //dd($post_filtrado);
    //dd($posts);
    
    //dd($id_user_follower);
    /*$posts = DB::table('posts')
    ->join('users', 'posts.user_id', '=', 'users.id')
    ->join('followers', 'followers.id_user_follower', '=', 'users.id')
    ->get();*/

    

    /*foreach($id_user_follower as $id_user){

        $posts= Post::all()->where('user_id', json_encode($id_user));

    }*/

    return view('dashboard', ["posts" => $post_filtrado->items]);

    }
}  