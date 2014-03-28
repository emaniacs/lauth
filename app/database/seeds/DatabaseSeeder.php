<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$seeder = [
			'UsersTableSeeder',
		];
		Eloquent::unguard();

		foreach ($seeder as $seed) {
			$this->call($seed);
			$this->command->info($seed .' seeded!');
		}
	}

}
