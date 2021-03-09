<?php

use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		DB::table('users_roles')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('users_roles')->insert([
        	'user_id' => 1,
        	'role_id' => 1,
        ]);

        DB::table('users_roles')->insert([
            'user_id' => 2,
            'role_id' => 2,
        ]);
        DB::table('users_roles')->insert([
            'user_id' => 3,
            'role_id' => 2,
        ]);
    }
}
