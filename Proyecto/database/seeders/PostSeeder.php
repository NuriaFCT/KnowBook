<?php

/**
 * DESCRIPCION: Fichero que genera los registros de Post (Alimentadores)
 */

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Insercion de un post a mano
        DB::insert("INSERT INTO `posts` (`id`, `title`, `description`, `buy_on`, `date_publication`, `image`, `user_id`, `likes`, `comentarios`) 
        VALUES  (NULL, 'La saga magica de Harry Potter', 'Niño con un rayo en la frente', 'Amazon CasaLibro Carrefour', '2021-12-15', 'HP.jpg', '1', '0', '0')");

        //Llamada al factory que genera treinta entradas más con las indicaciones de cada campo
        Post::factory(30)->create();
    }
}
