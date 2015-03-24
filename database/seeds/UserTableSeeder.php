<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\User;

class UserTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		User::create(['name' => 'Erick', 'email' => 'erick.mo@vortege.com', 'password' => Hash::make('123'), 'username' => 'mo']);
	}

}
