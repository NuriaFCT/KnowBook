<?php
/*DESCRIPCION: Fichero que establece las relaciones de la Tabla Role con las otras tablas de la BD*/
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Establecemos la tabla asociada al modelo
    protected $table = 'roles';


    /**Definimos la relación  con la tabla Users. hasOne sirve para acceder al registro de users asociado al rol. Se 
      *supone que en la tabla usuarios existe un campo user_id fireng key a rol
    */
    public function user()
    {
        return $this->hasMany(User::class);
    }


}
