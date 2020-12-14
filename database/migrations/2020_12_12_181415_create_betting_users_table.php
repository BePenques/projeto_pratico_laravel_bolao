<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBettingUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('betting_user', function (Blueprint $table) {
            $table->integer('betting_id')->unsigned();//unsigned - so numeros positivos
            $table->integer('user_id')->unsigned();//unsigned - so numeros positivos
            $table->foreign('betting_id')->references('id')->on('bettings')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('points')->unsigned()->default(0);//unsigned - so numeros positivos
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('betting_user');
    }
}
