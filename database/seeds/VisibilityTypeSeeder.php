<?php

use Illuminate\Database\Seeder;

class VisibilityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\VisibilityType::truncate();
        App\VisibilityType::create([
        	'type' => 'Prywatny'
        ]);
        
        App\VisibilityType::create([
        	'type' => 'Publiczny'
        ]);
    }
}
