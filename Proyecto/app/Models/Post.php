<?php
/*DESCRIPCION: Fichero que establece las relaciones de la Tabla Post con las otras tablas de la BD*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

     /*
        Definimos la relacion con POST
        Un post tendrá muchos likes, pero solo le pertenecera a ese
     */
    public function like()
    {
        return $this->hasMany(Like::class);
    }


    /**Definimos la relación  con la tabla User. 
     * Un usuario podra hacer muchas publicaciones pero solo le perteneceran a él
    */
    public function user()
    {
        return $this->belongsTo(User::class);

    }

    /**Definimos la relación  con la tabla Comment. 
     * Una publicacion podra tener muchos comentarios pero solo le perteneceran a él
    */
    public function comment()
    {
        return $this->hasMany(Comment::class);

    }


}
