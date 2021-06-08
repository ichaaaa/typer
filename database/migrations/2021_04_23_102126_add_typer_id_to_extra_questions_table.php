<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTyperIdToExtraQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('extra_questions', function (Blueprint $table) {
            $table->unsignedBigInteger('typer_id');

            $table->foreign('typer_id')->references('id')->on('typer')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('extra_questions', function (Blueprint $table) {
            $table->dropColumn('typer_id');
        });
    }
}
