<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTypersUsersColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('typers_users', function (Blueprint $table) {

            $table->boolean('confirmed')->default('0')->change();
            $table->boolean('banned')->default('0')->change();
            $table->boolean('payed')->default('0')->change();
            $table->boolean('verified')->default('0')->change();
            $table->string('token')->nullable()->change();
            $table->string('verified_at')->nullable()->change();

                   
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
