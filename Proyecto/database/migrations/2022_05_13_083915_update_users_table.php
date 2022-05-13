<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     * 
     * Esto es una actualización de la tabla Users. 
     * 
     * Se concluye que la tabla estará formada por: id, email, nickname o name, 
     * password, biography, image_profile, role_id y alert_id
     *
     * @return void
     */
    public function up()
    {

        Schema::table('users', function (Blueprint $table) {

            $table->string('biography', 255)->nullable(); 
            $table->string('image_profile', 150)->nullable()->default(null); 
            $table->foreignId('role_id')->nullable()->constrained('roles'); 
            $table->foreignId('alert_id')->nullable()->constrained('alerts'); 


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
        Schema::dropIfExists('users');
    }
};
