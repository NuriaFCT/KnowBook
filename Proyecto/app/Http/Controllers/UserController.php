<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * 
     * Funcion que retorna la vista de un perfil
     * 
     * @return profile
     */
    public function profile(){
        return view('user.profile');
    }
}
