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
    	App\Permission::truncate();
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
