<?php
/*DESCRIPCION: Fichero que establece las relaciones de la Tabla Like con las otras tablas de la BD*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;


     /*Definimos la relación con la tabla User
      Un usuario podra dar muchos likes igual que recibir pero solo sera de una unica persona
     */
     public function user()
     {
         return $this->belongsTo(User::class);
     }

     /*
        Definimos la relacion con POST
        Un post tendrá muchos likes, pero solo le pertenecera a ese
     */
     public function post()
     {
         return $this->belongsTo(Post::class);
     }


}
