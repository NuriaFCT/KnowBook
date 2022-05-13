<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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


}
