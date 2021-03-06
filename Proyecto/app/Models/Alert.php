<?php

/*DESCRIPCION: Fichero que establece las relaciones de la Tabla Alert con las otras tablas de la BD*/


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    use HasFactory;


    /**Definimos la relación con la tabla Users. 
     * Un usuario tendrá muchas alertas (HasMany) pero solo le perteneceran a él (belongsTo)
    */
     public function user()
     {
         return $this->belongsTo(User::class);

     }

}
