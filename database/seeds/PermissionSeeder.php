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
        	'slug' => 'create-tasks',
        	'name' => 'Create Tasks',
        	]
        );

        App\Permission::create(
        	[
        	'slug' => 'edit-users',
        	'name' => 'Edit Users',
        	]
        );
    }
}
