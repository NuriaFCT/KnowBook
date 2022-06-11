<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\Like;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{


    /*
     Metodo para eliminar usuarios. Incluido foto
     Se envia por un formulario en la vista y se redirecciona nuevamente a la vista
     */
    public function destroy($id, Request $request)
    {

        Post::where('user_id', $id)->delete();
        Like::where('user_id', $id)->delete();
        Comment::where('user_id', $id)->delete();
        Follower::where('user_id', $id)->delete(); //yo sigo a
        Follower::where('id_user_follower', $id)->delete(); //alguien me sigue
        User::where('id', $id)->delete();
        
        //Si el usuario es el logueado, hay que cerrar la sesion.
        if ($id == Auth::user()->id) {
            //User::destroy($id); //de esta manera salta las violaciones sql
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/');
        } else {

            //User::destroy($id);
            return redirect()->route('dashboard')->with(['status' => 'Usuario borrado correctamente']);
        }
    }

    /**
     * 
     * Funcion que retorna la vista del perfil del usuario logueado
     * 
     * Se ha decidido hacer dos controladores para la vista porque se tendria que pasar 
     * el id del logueado y sus posts, ademas del perfil seleccionado lo que requeriria de parametros
     * 
     * @return profile
     */
    public function myprofile()
    {

        //Queda pendiente sacar los posts de ese id
        $user = User::find(Auth::user()->id); //encuentra al usuario logueado, su id

        //Con esto sacaremos lo posts del perfil que corresponda
        $posts = DB::table('posts')
            ->select('posts.*')
            ->where('posts.user_id', '=', Auth::user()->id)
            ->get();

        //Numero de publicaciones que tiene
        $numposts = DB::table('posts')
            ->select(DB::raw('count(posts.id) as contadorPosts'))
            ->where('posts.user_id', '=', Auth::user()->id)
            ->get();

        //Numero de seguidores
        $seguidores = DB::table('followers')
            ->select(DB::raw('count(followers.id) as contadorSeguidores'))
            //->join('users', 'followers.id_user_follower', '=', 'users.id')
            ->where('followers.user_id', '=', Auth::user()->id)
            ->get();

        //Numeros de seguidos o siguiendo
        $siguiendo = DB::table('followers')
            ->select(DB::raw('count(followers.id_user_follower) as contadorSeguidos'))
            //->join('users', 'followers.id_user_follower', '=', 'users.id')
            ->where('followers.id_user_follower', '=', Auth::user()->id)
            ->get();

        return view('user.profile', ['user' => $user, "posts" => $posts, "numposts" => $numposts, "seguidores" => $seguidores, "siguiendo" => $siguiendo]);
    }


    /**
     * Funcion que retorna el perfil del usuario picado
     * 
     * @param id
     * @return profile vista perfil
     */
    public function profile($id)
    {
     

        $id_logueado= Auth::user()->id;

        
        $misSeguidores_2 = Follower::all()->where('user_id', $id_logueado);
   

        $id_seguidores_2= array($misSeguidores_2);
    
        $array_ids_seguidores=array();

        foreach($id_seguidores_2[0] as $id_seguidor){
            $array_ids_seguidores[]=$id_seguidor->id_user_follower;
        }

        $misSeguidores = Follower::all();

        $seguidores_filtrado=array();
        foreach($misSeguidores as $seguidor){
            if (in_array($seguidor->id_user_follower,$array_ids_seguidores)){
                $seguidores_filtrado[]=$seguidor;
            }
            
        }
       
        $s="";
        foreach( $seguidores_filtrado as $id_seguidor){
          
            if($id_seguidor->id_user_follower==$id){
                //dd("Siguiendo");
                $s = "siguiendo";         

            }
        
          
        }

        //Con esto sacaremos la informacion del usuario
        $user = User::find($id);

        //Con esto sacaremos lo posts del perfil que corresponda
        $posts = DB::table('posts')
            ->select('posts.*')
            ->where('posts.user_id', '=', $id)
            ->get();

        //Numero de publicaciones que tiene
        $numposts = DB::table('posts')
            ->select(DB::raw('count(posts.id) as contadorPosts'))
            ->where('posts.user_id', '=', $id)
            ->get();

        //Numero de seguidores
        $seguidores = DB::table('followers')
            ->select(DB::raw('count(followers.id) as contadorSeguidores'))
            //->join('users', 'followers.id_user_follower', '=', 'users.id')
            ->where('followers.id_user_follower', '=', $id)
            ->get();

            //dd($id);

        //Numeros de seguidos o siguiendo
        $siguiendo = DB::table('followers')
            ->select(DB::raw('count(followers.id) as contadorSeguidos'))
            //->join('users', 'followers.id_user_follower', '=', 'users.id')
            ->where('followers.user_id', '=', $id_logueado)
            ->get();

           

        return view('user.profile', ['user' => $user, "posts" => $posts, "numposts" => $numposts, "seguidores" => $seguidores, "siguiendo" => $siguiendo, "s" => $s]);
    }


    /**
     * Vista de editar perfil
     */

    public function config()
    {
        //$user = User::find(Auth::user()->id);

        $datos['user'] = User::find(Auth::user()->id);

        return view('user.edit', $datos);
    }


    /**
     * Guardado de perfil
     */
    public function saveProfile(Request $request)
    {
        //El usuario del mismo id que el autenticado
        $user = User::find(Auth::user()->id);

        //Se valida los campos de la vista editar perfil
        $request->validate([

            'name' => 'required|string|max:255',
            'biography' => 'string|max:255'

        ]);

        //Se recibe la imagen
        $image_profile = $request->file('image_profile');

        if ($image_profile) {
            $image_name =  $image_profile->getClientOriginalName();
            Storage::disk('users')->put($image_name, File::get($image_profile));
            $user->image_profile = $image_name;
        }


        //Se almacenan y se guarda los cambios
        $user->name = $request->name;
        $user->biography = $request->biography;

        $id = $user->id;

        $user->save();



        //Llevamos a la vista de perfil, es decir, a la que se accede para editar indicando que esta todo correcto
        return redirect()->route('users.profile', ['id' => $id])->with(['status' => 'Perfil editado correctamente']);
    }


    /**
     * Función para seguir a otra cuenta
     */
    public function follow($id){

        $id_logueado= Auth::user()->id;

        $dateFollow['user_id']=$id_logueado;
        $dateFollow['id_user_follower']=$id;   

        Follower::insert($dateFollow);
        return redirect()->route('users.profile', ['id' => $id]);

        //return view('user.profile', ['user' => $user, "likes" => $likes, "comments" => $comments, "posts" => $posts, "numposts" => $numposts, "seguidores" => $seguidores, "siguiendo" => $siguiendo, "s" => $s]);
        
    }

    /**
     * Funcion para dejar de seguir
     */
    public function unfollow($id){

        Follower::where('id_user_follower', $id)->delete(); 
        return redirect()->route('users.profile', ['id' => $id]);

        //return view('user.profile', ['user' => $user, "likes" => $likes, "comments" => $comments, "posts" => $posts, "numposts" => $numposts, "seguidores" => $seguidores, "siguiendo" => $siguiendo, "s" => $s]);
        
    }

    
}
