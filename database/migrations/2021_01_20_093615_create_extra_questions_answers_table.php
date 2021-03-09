<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtraQuestionsAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra_questions_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('extra_question_id');
            $table->timestamps();

            $table->foreign('extra_question_id')->references('id')->on('extra_questions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('extra_questions_answers');
    }
}
