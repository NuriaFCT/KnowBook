<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{


     /*
     Metodo para eliminar usuarios. Incluido foto
     Se envia por un formulario en la vista y se redirecciona nuevamente a la vista
     */
    public function destroy($id)
    {
        //$user= User::findOrFail($id);
        // if(Storage::delete('users/'.$user->image)){
        User::destroy($id);
        //}
        return redirect()->route('searchs')->with(['status' => 'Usuario borrado correctamente']);
    }

    /**
     * 
     * Funcion que retorna la vista de un perfil
     * 
     * @return profile
     */
    public function profile(){

        $user = User::find(Auth::user()->id); //encuentra al usuario logueado, su id

        return view('user.profile', compact('user'));
    }

     /**
     * Vista de editar perfil
     */
    /*
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user')); 
    }*/
    
    /**
     * Vista de editar perfil
     */
    
    public function config()
    {
        //$user = User::find(Auth::user()->id);

        $datos['user']=User::find(Auth::user()->id);

        return view('user.edit', $datos); 
    }


     /**
     * Guardado de perfil
     */
    public function saveProfile(Request $request)
    {
        //El usuario del mismo id que el autenticado
        $user = User::find(Auth::user()->id);

        //Se valida los campos de la vista editar perfil
        $request->validate([

            'name' => 'required|string|max:255',
            'biography' => 'string|max:255'

        ]);

        //Se recibe la imagen
        $image_profile = $request->file('image_profile');

        if ($image_profile) {
            $image_name =  time() . $image_profile->getClientOriginalName();
            Storage::disk('users')->put($image_name, File::get($image_profile));
            $user->image_profile = $image_name;
        }

        //Se almacenan y se guarda los cambios
        $user->name = $request->name;
        $user->biography = $request->biography;

        $user->save();

        //Llevamos a la vista de perfil, es decir, a la que se accede para editar indicando que esta todo correcto
        return redirect()->route('users.profile')->with(['status' => 'Perfil editado correctamente']);
    }
}
