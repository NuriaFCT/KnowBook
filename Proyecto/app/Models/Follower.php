<?php
/*DESCRIPCION: Fichero que establece las relaciones de la Tabla Follower con las otras tablas de la BD*/
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    use HasFactory;


    /*
    Definimos la relacion de usuarios seguidores.

    Un usuario puede tener muchos seguidores y a su vez seguir a muchos.
    Por tanto de N:N o de muchos a muchos. Se crea esta tabla con el id de ambas, es decir, de dos usuarios
    */
    public function user(){

        return $this->belongsToMany(User::class);

    }


}
