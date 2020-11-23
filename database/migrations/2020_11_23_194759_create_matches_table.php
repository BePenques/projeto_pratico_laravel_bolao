<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('round_id')->unsigned();
            $table->foreign('round_id')->references('id')->on('rounds')->onDelete('cascade');
            $table->string('title');
            $table->string('stadium');
            $table->string('team_a');
            $table->string('team_b');
            $table->enum('result',['A','B','E']);
            $table->string('scoreboard_a');
            $table->string('scoreboard_b');
            $table->datetime('date');
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
        Schema::dropIfExists('matches');
    }
}
