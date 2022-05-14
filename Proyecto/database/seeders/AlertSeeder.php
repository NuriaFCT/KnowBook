<?php

/**
 * DESCRIPCION: Fichero que genera los registros de Alert (Alimentadores)
 */

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class AlertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Insercion de tres alertas a mano. Las unicas
        DB::insert("INSERT INTO `alerts` (`id`, `type`, `message`) 
        VALUES  (NULL, 'Like', 'Le ha gustado tu post')");

        DB::insert("INSERT INTO `alerts` (`id`, `type`, `message`) 
        VALUES  (NULL, 'Comment', 'Te ha comentado')");

        DB::insert("INSERT INTO `alerts` (`id`, `type`, `message`) 
        VALUES  (NULL, 'Follow', 'Te ha seguido')");

    }
}
