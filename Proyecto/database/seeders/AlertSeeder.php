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
        DB::insert("INSERT INTO `alerts` (`id`, `type`, `message`, `id_usuario`) 
        VALUES  (NULL, 'Like', 'Le ha gustado tu post', 13)");

        DB::insert("INSERT INTO `alerts` (`id`, `type`, `message`, `id_usuario`) 
        VALUES  (NULL, 'Comment', 'Te ha comentado', 17)");

        DB::insert("INSERT INTO `alerts` (`id`, `type`, `message`, `id_usuario`) 
        VALUES  (NULL, 'Follow', 'Te ha seguido', 13)");

    }
}
