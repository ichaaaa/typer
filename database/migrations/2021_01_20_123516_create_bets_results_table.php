<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBetsResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bets_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bet_id');
            $table->boolean('winning_team_guess');
            $table->boolean('extact_score_guess');
            $table->boolean('extra_question_guess');
            $table->float('points');
            $table->timestamps();

            $table->foreign('bet_id')->references('id')->on('bets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bets_results');
    }
}
