<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('SettingsTableSeeder');
		$this->call('PeopleTableSeeder');
		$this->call('UsersTableSeeder');
        $this->call('PagesTableSeeder');
     	$this->call('RolesTableSeeder');
        $this->call('PermissionsTableSeeder');
	}

}
