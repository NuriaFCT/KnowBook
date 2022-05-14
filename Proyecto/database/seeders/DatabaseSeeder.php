<?php

/**
 * DESCRIPCION: Fichero que genera los registros de toda la BD llamando al resto de Seeder (Alimentadores)
 */

namespace Database\Seeders;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       //Llamada al resto de seeder en un orden en funcion de las foreign key
        $this->call([
            RoleSeeder::class,
            AlertSeeder::class,
            UserSeeder::class,
            FollowerSeeder::class,
            PostSeeder::class,
            LikeSeeder::class,
            CommentSeeder::class
        ]);   

    }
}
