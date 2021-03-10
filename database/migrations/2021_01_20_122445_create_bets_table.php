<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('typer_id');
            $table->unsignedInteger('match_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedInteger('home_team_score');
            $table->unsignedInteger('away_team_score');
            $table->unsignedBigInteger('extra_question_answer_id');
            $table->boolean('sure_thing');
            $table->timestamps();

            $table->foreign('typer_id')->references('id')->on('typer')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('extra_question_answer_id')->references('id')->on('extra_questions_answers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bets');
    }
}
