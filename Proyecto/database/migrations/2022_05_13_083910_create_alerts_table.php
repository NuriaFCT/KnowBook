<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlertsTable extends Migration
{
    /**
     * Run the migrations.
     * 
     *  Creación de la tabla Alert con sus atributos
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alerts', function (Blueprint $table) {
            $table->id();
            $table->string('type',10); 
            $table->string('message',150); 
            $table->integer('id_usuario'); //quien hace la accion
            $table->timestamps();
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
        Schema::dropIfExists('alerts');
    }
};
