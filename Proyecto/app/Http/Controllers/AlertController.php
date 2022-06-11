<?php

namespace App\Http\Controllers;

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

        $alerts = DB::table('alerts')
        ->get();
 
        return view('alert.index', ["alerts"=>$alerts]);
    }
}
