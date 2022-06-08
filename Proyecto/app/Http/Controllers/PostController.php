<?php

namespace App\Http\Controllers;

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

        /*dd($id);
        //Con esto sacamos el post
        $post= Post::find($id);

         //Con esta consulta sacaremos el numero de likes por cada post
         $likes = DB::table('likes')
         ->select(DB::raw('count(likes.post_id) as contador'))
         ->where('likes.post_id', '=', $id) 
         ->get();

         //Con esta consulta sacaremos el numero de comentarios de cada post
         $comments = DB::table('comments')
         ->select(DB::raw('count(comments.post_id) as contadorComentarios'))
         ->where('comments.post_id', '=', $id)  
         ->get();

         //Con esto se saca la informacion del autor
         $users = DB::table('users')
         ->join('posts', 'posts.user_id', '=', 'users.id')
         ->where('posts.id', '=', $id)
         ->get();*/


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

       // $hola="hola";
        //dd($request);
        //Tal vez se pueda poner aqui una validacion

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

        
        $datePost = request()->except(['_token', '_method']);
        //dd($datePost);
        Post::where('id', '=',$id)->update($datePost);

        $post= Post::findOrFail($id);
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

        //Post::destroy($id); //con este modo salen las violation

    
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




}
