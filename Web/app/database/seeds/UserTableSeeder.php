<?php

class UserTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$root = [
			[
				'identifier' => UUID::v4(),
				'username' => 'neal.schilling@gmail.com',
				'email' => 'neal.schilling@gmail.com',
				'isActive' => true,
				'password' => Hash::make('password')
			]
		];
		DB::table('users')->insert($root);

		// $this->call('UserTableSeeder');
	}

}