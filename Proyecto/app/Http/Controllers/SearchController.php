<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{

    /**
     * Funcion que retorna la vista de busqueda con sus campos y categorias
     * 
     * @return index
     */
    public function index(){
        return view('search.index');
    }
}
