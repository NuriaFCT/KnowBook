<?php
/*DESCRIPCION: Fichero que establece las relaciones de la Tabla User con las otras tablas de la BD*/

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     // Establecemos la tabla asociada al modelo
     protected $table = 'users';

     //Definimos la relación con la tabla Role. 
     public function rol()
     {
         // Este método devuelve el array de objetos de rol asociado a usuario 
         return $this->belongsTo(Role::class);

     }

    /**Definimos la relación con la tabla Alerts. 
     * Un usuario tendrá muchas alertas pero solo le perteneceran a él
    */
    public function alert()
    {
        return $this->hasMany(Alert::class);
    }


     /*
        Definimos la relacion con Like
        Un usuario podra dar muchos likes igual que recibir pero solo sera de una unica persona
     */
    public function like()
    {
        return $this->hasMany(Like::class);
    }

    /**Definimos la relación  con la tabla Post. 
     * Un usuario podra hacer muchas publicaciones pero solo le perteneceran a él
    */
    public function post()
    {
        return $this->hasMany(Post::class);
    }

    /**Definimos la relación  con la tabla User. 
     * Un usuario podra dejar muchos comentarios pero solo son de él
    */
    public function comment()
    {
        return $this->hasMany(Comment::class);

    }


}
