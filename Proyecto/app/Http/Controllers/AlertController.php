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

        //Saca las alertas del logueado
        $alerts = DB::table('alerts')
        ->select('alerts.*')
        ->join('users', 'alerts.id', '=', 'users.alert_id')
        ->where('users.id', '=', Auth::user()->id)
        ->get();

        //Saca la imagen del usuario que ha realizado la accion, es decir, es necesario el user_id de like en caso de ser un me gusta
        $users = DB::table('users')
        ->select('users.image_profile')
        ->join('alerts', 'users.alert_id', '=', 'alerts.id')
        //->join('likes', 'users.id', '=', 'likes.user_id')
        ->where('users.id', '=', Auth::user()->id)
        ->get();

        //En parametros se le pasaba $nombre y se le adjuntaba en la vista. Si se hace no funciona

        return view('alert.index', ["alerts"=>$alerts, "users"=>$users]);
    }
}
