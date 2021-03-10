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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');        
    	App\Role::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');        
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
