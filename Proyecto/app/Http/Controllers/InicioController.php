<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\LIKE;

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

    $array_id_user_followers = array($id_user_follower);
    
    $posts = DB::table('posts')
    ->join('users', 'posts.user_id', '=', 'users.id')
    ->join('followers', 'followers.id_user_follower', '=', 'users.id')
    ->get();

    
    $id_posts = DB::table('posts')
    ->select('posts.id')
    ->join('users', 'posts.user_id', '=', 'users.id')
    ->join('followers', 'followers.id_user_follower', '=', 'users.id')
    ->get();
            
    $isEmpty = empty($array_id_user_followers[0][0]);

    //dd($array_id_user_followers[0][0]);
    //dd($isEmpty);

    if(!$isEmpty){

        foreach($array_id_user_followers as $id_user){

            //dd($id_user);
            $posts->Where('followers.id_user_follower', $id_user);

            $id_posts->Where('followers.id_user_follower', '=' , json_encode($id_user));    
        }
    
    }else{

        $posts = DB::table('posts')
        ->join('users', 'posts.user_id', '=', 'users.id')
        ->join('followers', 'followers.id_user_follower', '=', 'users.id')
        ->where('followers.id_user_follower', '=' , 0)
        ->get();
    }

    //dd($posts);

    $array_id_posts = array($id_posts);    
   

    //LIKES DE LOS POST

    $likes = LIKE::all()->pluck('post_id');
    
    $likes->Where('post_id', 6);

    //dd($likes);

    //dd($array_id_posts); Tiene 8 valores, debe recorrer el foreach 8 veces

   // foreach ($array_id_posts as  $id_post){
        
        //dd(json_encode($id_post));
        
        
        //$likes ->where('likes.post_id', '=', json_encode($id_post));
    //}
    

    

     //------------COMMENT. ------------Con esta consulta sacaremos el numero de comentarios de cada post
     $comments = DB::table('comments')
     ->select(DB::raw('count(comments.post_id) as contadorComentarios'))
     ->where('comments.post_id', '=', 34)  //hay que cambiar el 34 igual que arriba
     ->get();


    return view('dashboard', ["posts" => $posts, "likes"=>$likes, "comments"=>$comments]);

    }
}  