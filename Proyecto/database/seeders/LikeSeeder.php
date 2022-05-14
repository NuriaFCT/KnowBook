<?php

/**
 * DESCRIPCION: Fichero que genera los registros de Like (Alimentadores)
 */

namespace Database\Seeders;

use App\Models\Like;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Insercion de un like a mano
        DB::insert("INSERT INTO `likes` (`id`, `user_id`, `post_id`) 
        VALUES  (NULL, '1', '1')");

        //Llamada al factory que genera quince entradas más con las indicaciones de cada campo
       Like::factory(15)->create();

    }
}
