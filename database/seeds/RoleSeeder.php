<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	App\Role::truncate();
        App\Role::create(
        	[
        	'slug' => 'developer',
        	'name' => 'Front-end Developer',
        	]
        );

        App\Role::create(
        	[
        	'slug' => 'manager',
        	'name' => 'Assistant Manager',
        	]
        );
    }
}
