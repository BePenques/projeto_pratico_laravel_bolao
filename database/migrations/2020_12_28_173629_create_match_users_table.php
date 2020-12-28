<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_user', function (Blueprint $table) {
            $table->integer('match_id')->unsigned();//unsigned - so numeros positivos
            $table->integer('user_id')->unsigned();//unsigned - so numeros positivos
            $table->foreign('match_id')->references('id')->on('matches')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->enum('result',['A','B','E'])->default('E');
            $table->string('scoreboard_a')->deafult('0');
            $table->string('scoreboard_b')->deafult('0');
         //   $table->enum('status',['active','processed','canceled'])->default('active');
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
        Schema::dropIfExists('match_user');
    }
}
