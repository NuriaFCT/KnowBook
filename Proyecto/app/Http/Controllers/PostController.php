<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use App\Models\Post;
use App\Models\Like;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Mockery\Undefined;

class PostController extends Controller
{
    

    /**
     * 
     * Funcion que retorna la vista de creacion de una publicacion, un formulario
     * 
     * @return create
     */
    public function create(){
        return view('post.create');   
    }

    /**
     * Vista en detalle de los posts
     * Se accede por medio de search, por ejemplo.
     * Se activa cuando se pulsa sobre un post previsualizacion previa (card) por el vector ojo
     * Se pasa el id y se dirige a la vista en detalle
     */
    public function show($id){

         $datos= DB::table('posts')
         ->select(DB::raw('posts.*, count(likes.id) as contadorLikes, count(comments.id) as contadorComments, users.name, users.image_profile'))
         ->join('likes','likes.post_id', '=', 'posts.id')
         ->join('comments','comments.post_id', '=', 'posts.id')
         ->join('users','users.id', '=', 'posts.user_id')
         ->where('posts.id', $id)
         ->get();
        
        return view('post.show', ["datos"=>$datos]);
    }

    /**
     * 
     *  Metodo para almacenar usuarios
     *  Pido que almacene todos los datos a excepción del campo token
     * 
     *  @param request
     * 
     * */ 

    public function store(Request $request)
    {

        $id = Auth::user()->id;

        $datePost = request()->except('_token');

        //dd($datePost);
        if ($request->hasFile('image')) {

            $datePost['image'] = $request->file('image')->store('posts');
        }

        $datePost['user_id'] = $id;
        $datePost['date_publication'] = Carbon::now();
        //dd($datePost['date_publication']);
      
        Post::insert($datePost);
        return redirect()->route('dashboard')->with(['status' => 'Post creado correctamente']);
    }


    /**
     * Metodo para editar post
     * Desde la vista se indica el id y se llama a este método que devuelve la vista de formulario de edicion
     * 
     * @param id
     * @return view
     */
    public function edit($id){

        $post= Post::findOrFail($id);
        return view('post.edit', compact('post'));

    }

    /*
        Metodo para actualizar los datos
        Despues de haber dado click al boton de la vista de edicion
    */
    public function update(Request $request, $id){

        /*
        $post = Post::where('id', '=',$id);

        //dd($post);

        $request->validate([

            'title' => 'required|string|max:150',
            'description' => 'required|string|max:6500',
            'buy_on' => 'required|string|max:150'

        ]);

        //dd($request);

        $image = $request->file('image');

        dd($image);

        if ($image) {
            $image_name =  $image->getClientOriginalName();
            Storage::disk('posts')->put($image_name, File::get($image));
            $post->image = $image_name;
        }

        $post->title = $request->title;
        $post->description = $request->description;
        $post->buy_on = $request->buy_on;
        $id = $post->id;
        $post->save();

        */
        
        $datePost = request()->except(['_token', '_method']);
        //dd($datePost);
        Post::where('id', '=',$id)->update($datePost);

        return redirect()->route('dashboard')->with(['status' => 'Post actualizado correctamente']);
    }

    /*
     Metodo para eliminar posts. Incluido foto
     Se envia por un formulario en la vista y se redirecciona nuevamente a la vista
     */
    public function destroy($id)
    {
 
        Like::where('post_id', $id)->delete();
        Comment::where('post_id', $id)->delete();
        Post::where('id', $id)->delete();
           
        return redirect()->route('dashboard')->with(['status' => 'Post borrado correctamente']);
    }

    /**
     * Devolver la imagen almacenada, para que se muestre
     */
    public function getImage($filename = 'image.png')
    {
        $file = Storage::disk('posts')->get($filename);
        return new Response($file, 200);
    }



    /**
     * Contador de likes y añade la alerta
     * 
     */

     public function like($id){


            //Crear funcion para sumar uno a los likes de post
            $likes = Post::all()->where('id', $id);
       
            $id_2= array($likes);

            $array_ids=array();

            foreach($id_2[0] as $id_user){
                $array_ids[]=$id_user->likes;
            }

            $contadorLike=$array_ids[0];

            DB::table('posts')
            ->where('id', $id) 
            ->update(['likes' => $contadorLike+1]);

             //Funcion para la creacion de la alerta

             
             $type="Like";
             $message="Le ha gustado tu post";

             $datePost['type'] = $type;
             $datePost['message'] = $message;
             $datePost['id_usuario'] = Auth::user()->id; 

             Alert::insert($datePost);

             return redirect()->route('dashboard');

     }


     /***
      * Contador de comentarios y añade la alerta
      */
     public function comentarios($id){


         //Crear funcion para sumar uno a los comentarios de post
         $comentarios = Post::all()->where('id', $id);
       
         $id_2= array($comentarios);

         $array_ids=array();

         foreach($id_2[0] as $id_user){
             $array_ids[]=$id_user->comentarios;
         }

         $contadorComentario=$array_ids[0];

         DB::table('posts')
         ->where('id', $id) 
         ->update(['comentarios' => $contadorComentario+1]);

          //Funcion para la creacion de la alerta

          $type="Comment";
          $message="Ha comentado un post";

          $datePost['type'] = $type;
          $datePost['message'] = $message;
          $datePost['id_usuario'] = Auth::user()->id; 

          Alert::insert($datePost);

          return redirect()->route('dashboard');
     }


     /**
      * Funcion que muestra la vista de form para dejar un comentario
      */

     public function createComment ($id){

        //$post= Post::findOrFail($id);
        return view('comment.create', ["id"=>$id] );

     }

     /**
      * Funcion que guarda el comentario
      */

      public function saveComment (Request $request){

        $id_usuario = Auth::user()->id;

        $comentario = array([
            'text' => $request->text,
            'user_id' => $id_usuario,
            'post_id' => $request->post_id
        ]);


        Comment::insert($comentario);

        $comentarios = Post::all()->where('id', $request->post_id);
       
         $id_2= array($comentarios);

         $array_ids=array();

         foreach($id_2[0] as $id_user){
             $array_ids[]=$id_user->comentarios;
         }

         $contadorComentario=$array_ids[0];

         DB::table('posts')
         ->where('id', $request->post_id) 
         ->update(['comentarios' => $contadorComentario+1]);

        return redirect()->route('dashboard');

     }

     /***
      * Funcion para listar todos los comentarios de este post
      Necesita la id del post
      */

     public function showComments($id)
      {

        //dd($id);
        $datos = DB::table('comments')
        ->select(DB::raw('comments.*, users.name, users.image_profile'))
        ->join('users','users.id', '=', 'comments.user_id')
        ->where('comments.post_id', '=', $id)
        ->get();

        return view('comment.list', ["datos"=>$datos]);
      }


}
