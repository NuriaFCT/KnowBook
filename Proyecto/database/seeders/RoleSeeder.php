<?php
/**
 * DESCRIPCION: Fichero que genera los registros de Tol (Alimentadores)
 */

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Insercion de dos roles a mano y los únicos
        DB::insert(" INSERT INTO `roles` (`id`, `type`) VALUES (1, 'Admin')");
        DB::insert(" INSERT INTO `roles` (`id`, `type`) VALUES (2, 'Usuario')");


    }
}
