<?php
/**
 * DESCRIPCION: Fichero que genera los registros de User (Alimentadores)
 */

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        //Insercion de dos usuarios a mano
        DB::insert("INSERT INTO `users` (`id`, `name`, `email`, `password`, `biography`, `image_profile`, `role_id`, `alert_id`) 
        VALUES  (NULL, 'Vazquez Diaz', 'mario@gmail.com', 'mario', 'Me encanta leer', 'avatar.png', '2', '1')");


        DB::insert("INSERT INTO `users` (`id`, `name`, `email`, `password`, `biography`, `image_profile`, `role_id`, `alert_id`) 
        VALUES  (NULL, 'Storm', 'storm@gmail.com', 'periPro', 'Trabajando', 'avatar.png', '1', null)");

        //Llamada al factory que genera diez entradas más con las indicaciones de cada campo
        User::factory(10)->create();

    }
}
