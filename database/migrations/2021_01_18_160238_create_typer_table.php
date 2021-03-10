<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTyperTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('typer', function (Blueprint $table) {
            $table->increments('id');
            
            $table->unsignedInteger('competition_id');
            $table->unsignedBigInteger('data_provider_id');
            $table->unsignedBigInteger('visibility_type_id');

            $table->float('membership_fee_amount', 5, 2);
            $table->string('membership_fee_currency', 3);
            $table->unsignedInteger('awarded_positions');
            $table->unsignedInteger('status');
            $table->timestamps();

            $table->foreign('data_provider_id')->references('id')->on('data_providers')->onDelete('cascade');
            $table->foreign('visibility_type_id')->references('id')->on('visibility_types')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('typer');
    }
}
