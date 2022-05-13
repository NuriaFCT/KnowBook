<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     * 
     * Creacion de la tabla comments con sus atributos
     * 
     * Id del mensaje, contenido, el autor, el post al que pertenece y su respuesta
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('text', 255); 
            $table->timestamps();

            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('post_id')->constrained('posts');
            $table->foreignId('comment_replied_id')->constrained('comments');
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
        Schema::dropIfExists('comments');
    }
};
