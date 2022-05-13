<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlertController extends Controller
{

    /**
     * 
     * Funcion que retorna la vista con las alertas recibidas
     * 
     * @return index
     */
    public function index(){
        return view('alert.index');
    }
}
