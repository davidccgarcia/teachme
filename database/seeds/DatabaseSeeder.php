<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	protected $tables = [
		'users', 'tickets', 'votes', 'comments', 'password_resets'
	];

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->checkForeignKeys(false);
		$this->truncate($this->tables);
		$this->checkForeignKeys(true);

		$this->call('UserTableSeeder');
	}

	protected function truncate(array $tables)
	{
		foreach ($tables as $table) {
			DB::table($table)->truncate();
		}
	}

	protected function checkForeignKeys($check)
	{
		$check = $check ? '1' : '0';
		DB::statement('SET FOREIGN_KEY_CHECKS = ' . $check);
	}

}
