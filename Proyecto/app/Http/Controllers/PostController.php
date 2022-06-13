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

class PostController extends Controller
{
    

    /**
     * 
     * Funcion que retorna la vista de creacion de una publicacion, un formulario
     * 
     * @return create vista formulario para la creación de post
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

        //Se saca toda la información del post
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
     *  @param request la informacion dada en el form
     *  @return redirect redirige al inicio avisando de la operacion
     * 
     * */ 

    public function store(Request $request)
    {

        //Se saca el id del usuario logueado y por tanto creador del post
        $id = Auth::user()->id;

        //Se guarda todos los datos excepto el token
        $datePost = request()->except('_token');

        if ($request->hasFile('image')) {

            $datePost['image'] = $request->file('image')->store('posts');
        }

        //Se guarda en el array
        $datePost['likes']=0;
        $datePost['comentarios']=0;
        $datePost['user_id'] = $id;
        $datePost['date_publication'] = Carbon::now(); //se genera la fecha actual

        //se inserta  
        Post::insert($datePost);

        return redirect()->route('dashboard')->with(['status' => 'Post creado correctamente']);
    }


    /**
     * Metodo para editar post
     * Desde la vista se indica el id y se llama a este método que devuelve la vista de formulario de edicion
     * 
     * @param id del post a actualizar
     * @return view form de edicion con los datos del post seleccionado
     */
    public function edit($id){

        $post= Post::findOrFail($id);
        return view('post.edit', compact('post'));

    }

    /**
     *  Metodo para actualizar los datos
     *  Despues de haber dado click al boton de la vista de edicion
     *  @param request la informacion del formulario
     *  @param id numero del post editado
     *  @return redirect dashboard con un mensaje de la operacion
     */    
    public function update(Request $request, $id){
        
        //Se guarda los datos y se actualiza el post de esa id
        $datePost = request()->except(['_token', '_method']);
        Post::where('id', '=',$id)->update($datePost);

        return redirect()->route('dashboard')->with(['status' => 'Post actualizado correctamente']);
    }

    /**
     *  Metodo para eliminar posts. Incluido foto
     *  Se envia por un formulario en la vista y se redirecciona nuevamente a la vista
     *  @param id el id del post a eliminar
     *  @return redirect dashboard con un mensaje de la operacion
     */
    
    public function destroy($id)
    {
 
        //Se borra antes las tablas anteriores vinculadas a esta 
        Like::where('post_id', $id)->delete();
        Comment::where('post_id', $id)->delete();
        Post::where('id', $id)->delete();
           
        return redirect()->route('dashboard')->with(['status' => 'Post borrado correctamente']);
    }

    /**
     * NO SE USA
     * Devolver la imagen almacenada, para que se muestre
     * 
     * @param filenmae nombre de la imagen
     * 
     * @return new Response
     */
    public function getImage($filename = 'image.png')
    {
        $file = Storage::disk('posts')->get($filename);
        return new Response($file, 200);
    }



    /**
     * Contador de likes y añade la alerta
     * @param id del post al que se pica para dar el like
     * @return redirect dashboard
     */

     public function like($id){


            //Crear funcion para sumar uno a los likes de post. Se actualiza la tabla
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

             return redirect()->route('dashboard')->with(['status' => 'Se ha dado like al post correctamente']);

     }


     /**
      * NO SE USA (No tiene sentido que funcionara como un like, se deberia crear un comentario para andar sumando)
      * Contador de comentarios y añade la alerta
      * @param id del post al que se pica para dar el like
      * @return redirect dashboard
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

          return redirect()->route('dashboard')->with(['status' => 'Se ha sumado un comentario al post correctamente']);
     }


     /**
      * Funcion que muestra la vista de form para dejar un comentario
      * @param id id del post
      * @return view form de creacion de comentarios
      */

     public function createComment ($id){

        return view('comment.create', ["id"=>$id] );

     }

     /**
      * Funcion que guarda el comentario
      * @param request informacion del formulario
      * @return dashboard redirige al inicio
      */
      public function saveComment (Request $request){

        //Se guarda lo recibido y se inserta en la tabla comment
        $id_usuario = Auth::user()->id;
        $comentario = array([
            'text' => $request->text,
            'user_id' => $id_usuario,
            'post_id' => $request->post_id
        ]);
        Comment::insert($comentario);

        //Se actualiza tambien el campo comentarios de la tabla post
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

         //Añadir una alerta
          $type="Comment";
          $message="Ha comentado un post";

          $datePost['type'] = $type;
          $datePost['message'] = $message;
          $datePost['id_usuario'] = Auth::user()->id; 

          Alert::insert($datePost);
         return redirect()->route('dashboard')->with(['status' => 'Se ha comentado en el post correctamente']);
         
     }

     /**
      * Funcion para listar todos los comentarios de este post
      * @param id del post
      * @return view list vista de listado de comentarios de ese post
      */

     public function showComments($id)
      {

        $datos = DB::table('comments')
        ->select(DB::raw('comments.*, users.name, users.image_profile, posts.user_id as autor'))
        ->join('users','users.id', '=', 'comments.user_id')
        ->join ('posts', 'posts.id', '=', 'comments.post_id')
        ->where('comments.post_id', '=', $id)
        ->get();

        //dd($datos);

        return view('comment.list', ["datos"=>$datos]);
      }

    /**
     * Funcion para borrar comentarios
     * @param id del comentario
     * @return dashboard avisando de la operacion realizada
     */
      public function destroyComments ($id){

         //Tambien el campo comentarios en posts. Para ello necesito el post al cual pertenece a ese comentario
        $post_id=DB::table('comments')
        ->select('comments.post_id')
        ->where('comments.id', '=', $id)
        ->get();

        $array_post_id = array($post_id);
       

         $array_ids=array();

         foreach($array_post_id[0] as $id_user){
             $array_ids[]=$id_user->post_id;
         }

         
         $post = Post::all()->where('id', $array_ids[0]);
         
         $array_post= array($post);

         $array_auxiliar = array();

         foreach($array_post[0] as $post){
            $array_auxiliar[]=$post->comentarios;
            $array_auxiliar[]=$post->id;
         }

         $contadorComentario=$array_auxiliar[0];
         $id_post_2=$array_auxiliar[1];

         DB::table('posts')
         ->where('id', $id_post_2) 
         ->update(['comentarios' => $contadorComentario-1]);

        //Habria que borrar el comentario de la tabla Comments
         Comment::where('id', $id)->delete();
            
         return redirect()->route('dashboard')->with(['status' => 'Comentario borrado correctamente']);

      }

      /**
      * Funcion que muestra la vista de form para editar un comentario
      * @param id id del comentario
      * @return view form de creacion de comentarios
      */

     public function editComment ($id){

        $comment= Comment::findOrFail($id);
        return view('comment.edit', ["comment"=>$comment] );

     }


     /**
      * Funcion para actualizar el comentario
      * @param id id del comentario
      * @param request informacion del formulario
      * @return dashboard avisando el exito de la accion
      */
      public function updateComment(Request $request, $id)
      {

        //Se guarda los datos y se actualiza el comentario de esa id
        $dateComment = request()->except(['_token', '_method']);
        Comment::where('id', '=',$id)->update($dateComment);

        return redirect()->route('dashboard')->with(['status' => 'Comentario actualizado correctamente']);

      }


}
