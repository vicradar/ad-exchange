<?php

class AdItemTablesSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$standardPlatforms = [
			[
				'identifier' => 'iphone',
				'title' => 'iPhone'
			],
			[
				'identifier' => 'ipad',
				'title' => 'iPad'
			],
			[
				'identifier' => 'android',
				'title' => 'Android'
			],
			[
				'identifier' => 'wp8',
				'title' => 'Windows Phone 8'
			],
			[
				'identifier' => 'win8',
				'title' => 'Windows 8/RT'
			]
		];

		DB::table('platforms')->insert($standardPlatforms);
	}

}