<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTypersUsersVerifiedAtRawSqlColumnColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('typers_users', function (Blueprint $table) {
            $table->dropColumn('verified_at');
        });

        Schema::table('typers_users', function (Blueprint $table) {
            $table->timestamp('verified_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('typers_users', function (Blueprint $table) {
            $table->dropColumn('verified_at');
        });

        Schema::table('typers_users', function (Blueprint $table) {
            $table->timestamp('verified_at');
        });
    }
}
