<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     * 
     * Creación de la tabla Rol con sus atributos
     * 
     * Id Y type (usuario normal o administrador)
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('type',10); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * 
     * En caso de existir, se borrará y se creara de nuevo
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
};
