<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		App\User::truncate();

		App\User::create(
			[
				'name' => 'Kamil Goliński',
				'email' => 'golinski.kamil88@gmail.com',
				'password' => bcrypt('password')
			]
		);

		App\User::create(
			[
				'name' => 'Ichaaaa',
				'email' => 'ichaaaa@op.pl',
				'password' => bcrypt('password')
			]
		);

		App\User::create(
			[
				'name' => 'Niuniek',
				'email' => 'ichaaaa@test.pl',
				'password' => bcrypt('password')
			]
		);


    }
}
