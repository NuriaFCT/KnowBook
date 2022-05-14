<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

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
     * 
     *  Metodo para almacenar usuarios
     *  Pido que almacene todos los datos a excepción del campo token
     * 
     *  @param request
     * 
     * */ 

    public function store(Request $request)
    {
        $datePost = request()->except('_token');
        if ($request->hasFile('image')) {

            $datePost['image'] = $request->file('image')->store('posts');
        }
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
        Post::where('id', '=',$id)->update($datePost);

        $post= Post::findOrFail($id);
        return view('post.edit', compact('post'));
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
