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
        	'slug' => 'admin',
        	'name' => 'Administrator',
        	]
        );

        App\Role::create(
        	[
        	'slug' => 'user',
        	'name' => 'Użytkownik',
        	]
        );
    }
}
