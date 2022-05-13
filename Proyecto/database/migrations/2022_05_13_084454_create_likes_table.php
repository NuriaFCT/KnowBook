<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     * 
     * Creación de la tabla Likes y sus atributos
     * 
     * Id like, quien da like y el post al que pertenece
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();


            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('post_id')->constrained('posts');

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
        Schema::dropIfExists('likes');
    }
};
