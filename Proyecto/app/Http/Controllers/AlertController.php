<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
 
        //En parametros se le pasaba $nombre y se le adjuntaba en la vista. Si se hace no funciona
        //dd($users);
        return view('alert.index', ["alerts"=>$alerts]);
    }
}
