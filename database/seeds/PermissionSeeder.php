<?php

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    	App\Permission::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        App\Permission::create(
        	[
        	'slug' => 'system-administration',
        	'name' => 'System administration',
        	]
        );

        App\Permission::create(
        	[
        	'slug' => 'system-use',
        	'name' => 'System use',
        	]
        );
    }
}
