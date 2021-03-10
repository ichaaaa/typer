<?php

use Illuminate\Database\Seeder;

class DataProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        App\DataProvider::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        App\DataProvider::create([
        	'const_id' => 1,
        	'name' => 'Football Data',
        	'website' => 'football-data.org',
        	'active' => 1,
        ]);
    }
}
