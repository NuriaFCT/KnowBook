<?php

/**
 * DESCRIPCION: Fichero que genera los registros de Comment (Alimentadores)
 */

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Insercion de un comentario a mano
        DB::insert("INSERT INTO `comments` (`id`, `text`, `user_id`, `post_id`, `comment_replied_id`) 
        VALUES  (NULL, 'Gran trabajo', '2', '1', null)");

        DB::insert("INSERT INTO `comments` (`id`, `text`, `user_id`, `post_id`, `comment_replied_id`) 
        VALUES  (NULL, 'Genial', '3', '1', null)");

        DB::insert("INSERT INTO `comments` (`id`, `text`, `user_id`, `post_id`, `comment_replied_id`) 
        VALUES  (NULL, 'Muy cierto', '2', '1', null)");

        DB::insert("INSERT INTO `comments` (`id`, `text`, `user_id`, `post_id`, `comment_replied_id`) 
        VALUES  (NULL, 'Gracias!', '1', '1', '1')");
        
        
       /*Llamada al factory que genera diez entradas más con las indicaciones 
       de cada campo
       
       No se usa porque genera errores al ser reflexiva
       
       */
       //Comment::factory(10)->create();

    }
}
