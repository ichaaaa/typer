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
        App\DataProvider::truncate();
        App\DataProvider::create([
        	'const_id' => 1,
        	'name' => 'Football Data',
        	'website' => 'football-data.org',
        	'active' => 1,
        ]);
    }
}
