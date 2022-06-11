<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\Like;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{


    /**
     *  Metodo para eliminar usuarios. Incluido foto
     *  Se envia por un formulario en la vista y se redirecciona nuevamente a la vista
     *  @param id clave primaria del usuario a borrar
     *  @param request nos permitirá cerrar la sesión
     *  @return redirect a login si el usuario es logueado sino al inicio 
     */
    
    public function destroy($id, Request $request)
    {

        //Se borra antes las tablas que tiran de ella
        Post::where('user_id', $id)->delete();
        Like::where('user_id', $id)->delete();
        Comment::where('user_id', $id)->delete();
        Follower::where('user_id', $id)->delete(); //yo sigo a
        Follower::where('id_user_follower', $id)->delete(); //alguien me sigue
        User::where('id', $id)->delete();
        
        //Si el usuario es el logueado, hay que cerrar la sesion y redirigir al login.
        if ($id == Auth::user()->id) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/');
        //Si no lo es, borra y continua dentro de la app.l    
        } else {

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
     * Hay un controlador para mi perfil y otro para los usuarios. La vista se mantiene
     * 
     * @return profile nuestro perfil
     */
    public function myprofile()
    {

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
            ->where('followers.user_id', '=', Auth::user()->id)
            ->get();

        //Numeros de seguidos o siguiendo
        $siguiendo = DB::table('followers')
            ->select(DB::raw('count(followers.id_user_follower) as contadorSeguidos'))
            ->where('followers.id_user_follower', '=', Auth::user()->id)
            ->get();

        return view('user.profile', ['user' => $user, "posts" => $posts, "numposts" => $numposts, "seguidores" => $seguidores, "siguiendo" => $siguiendo]);
    }


    /**
     * Funcion que retorna el perfil del usuario picado
     * 
     * @param id usuario al que se accede
     * @return profile vista perfil
     */
    public function profile($id)
    {
     
        /*
        Con este fragmento de código se saca si seguimos al usuario o no
        Se recoge los seguidos que tiene la cuenta logueada y se almacenan en un array 
        que es filtrado. Luego en un bucle se compara el id pasado con los almacenados
        */
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
            ->where('followers.id_user_follower', '=', $id)
            ->get();

        //Numeros de seguidos o siguiendo
        $siguiendo = DB::table('followers')
            ->select(DB::raw('count(followers.id) as contadorSeguidos'))
            ->where('followers.user_id', '=', $id_logueado)
            ->get();

        return view('user.profile', ['user' => $user, "posts" => $posts, "numposts" => $numposts, "seguidores" => $seguidores, "siguiendo" => $siguiendo, "s" => $s]);
    }


    /**
     * Vista de editar perfil
     * 
     * @return user.edit devuelve la vista de formulario para actualizar el perfil 
     */

    public function config()
    {
        //Metemos los datos del usuario logueado en un array al que pasamos a la vista donde se mostrará en los campos
        $datos['user'] = User::find(Auth::user()->id);

        return view('user.edit', $datos);
    }


    /**
     * Guardado de perfil
     * 
     * @param request nos permitirá recoger todos los datos del formulario
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
     * 
     * @param id usuario al que se accede al perfil
     * 
     * @return redireccion al perfil de ese id actualizado
     */
    public function follow($id){

        $id_logueado= Auth::user()->id;

        $dateFollow['user_id']=$id_logueado;
        $dateFollow['id_user_follower']=$id;   

        Follower::insert($dateFollow);
        return redirect()->route('users.profile', ['id' => $id]);
        
    }

    /**
     * Funcion para dejar de seguir
     * 
     * @param id del usuario al que se accede
     * @return redireccion a la misma vista actualizada
     */
    public function unfollow($id){

        Follower::where('id_user_follower', $id)->delete(); 
        return redirect()->route('users.profile', ['id' => $id]);
        
    }

    
}
