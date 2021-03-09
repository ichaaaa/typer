<?php

use Illuminate\Database\Seeder;

class RolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		DB::table('roles_permissions')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('roles_permissions')->insert([
        	'role_id' => 1,
        	'permission_id' => 1,
        ]);

        DB::table('roles_permissions')->insert([
        	'role_id' => 2,
        	'permission_id' => 2,
        ]);
    }
}
