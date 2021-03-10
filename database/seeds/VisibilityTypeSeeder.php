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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        App\VisibilityType::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        App\VisibilityType::create([
        	'type' => 'Prywatny'
        ]);
        
        App\VisibilityType::create([
        	'type' => 'Publiczny'
        ]);
    }
}
