<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypersUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('typers_users', function (Blueprint $table) {
            $table->unsignedInteger('typer_id');
            $table->unsignedInteger('user_id');
            $table->boolean('confirmed');
            $table->boolean('banned');
            $table->boolean('payed');
            $table->boolean('verified');
            $table->string('token');
            $table->timestamp('verified_at');

            $table->foreign('typer_id')->references('id')->on('typer')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->primary(['typer_id','user_id']);
                   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('typers_users');
    }
}
