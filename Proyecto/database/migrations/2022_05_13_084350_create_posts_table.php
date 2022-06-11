<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     * 
     * Creacion de la tabla Post y sus atributos
     * 
     * Id del post, titulo descripcion, imagen, fecha de publicación, id del usuario que publica y donde comprarlo 
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title',150); 
            $table->string('description', 6500); 
            $table->string('buy_on', 150); 
            $table->date('date_publication');
            $table->string('image',150);  
            $table->string('likes',20);
            $table->string('comentarios',20);
            $table->timestamps();

            $table->foreignId('user_id')->constrained('users');

        });
    }

    /**
     * Reverse the migrations.
     * 
     * En caso de existir, se borrara y se creara de nuevo
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
