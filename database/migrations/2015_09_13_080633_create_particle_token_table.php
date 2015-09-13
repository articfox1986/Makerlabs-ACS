<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticleTokenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('particle_token', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fk_particle_user_id');
            $table->string('token')->unique();
            $table->dateTime('expiry_date');
            $table->boolean('enabled')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('particle_token');
    }
}
