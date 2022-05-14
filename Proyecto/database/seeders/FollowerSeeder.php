<?php

/**
 * DESCRIPCION: Fichero que genera los registros de Follower(Alimentadores)
 */

namespace Database\Seeders;

use App\Models\Follower;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FollowerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Insercion de un seguidor a mano
        DB::insert("INSERT INTO `followers` (`id`, `user_id`) 
        VALUES  (NULL, '1')");

       //Llamada al factory que genera diez entradas más con las indicaciones de cada campo
       Follower::factory(10)->create();
    }
}
