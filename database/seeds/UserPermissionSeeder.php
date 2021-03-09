<?php

use Illuminate\Database\Seeder;

class UserPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		DB::table('users_permission')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('users_permission')->insert([
        	'user_id' => 1,
        	'permission_id' => 1,
        ]);

        DB::table('users_permission')->insert([
            'user_id' => 2,
            'permission_id' => 2,
        ]);

        DB::table('users_permission')->insert([
            'user_id' => 3,
            'permission_id' => 2,
        ]);
    }
}
