<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlertController extends Controller
{

    /**
     * 
     * Funcion que retorna la vista con las alertas recibidas
     * 
     * @return index
     */
    public function index(){

        //Por el momento mientras no se sepa sacar las propias del logueado
        $datos['alerts'] = DB::table('alerts')->select('alerts.*')->get();
        return view('alert.index', $datos);
    }
}
