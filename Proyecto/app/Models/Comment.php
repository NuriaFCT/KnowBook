<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;


    /**Definimos la relación  con la tabla Post. 
     * Una publicacion podra tener muchos comentarios pero solo le perteneceran a él
    */
    public function post()
    {
        return $this->belongsTo(Post::class);

    }

    /**Definimos la relación  con la tabla User. 
     * Un usuario podra dejar muchos comentarios pero solo son de él
    */
    public function user()
    {
        return $this->belongsTo(User::class);

    }


    /*
        La relacion de los comentarios. 
        Un comentario podra ser respondido muchas veces pero sus respuestas solo le perteneceran a él
    */

    public function comment_replied()
    {
        return $this->belongsTo(Comment::class);

    }

    public function comment()
    {
        return $this->hasMany(Comment::class, 'comment_replied_id');
    }



}
