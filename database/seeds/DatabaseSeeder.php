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

		$this->truncate($this->tables);
		
		$this->call('UserTableSeeder');
		$this->call('TicketTableSeeder');
		$this->call('VoteTableSeeder');
		$this->call('CommentTableSeeder');
	}

	protected function truncate(array $tables)
	{
		$this->checkForeignKeys(false);

		foreach ($tables as $table) {
			DB::table($table)->truncate();
		}
		
		$this->checkForeignKeys(true);
	}

	protected function checkForeignKeys($check)
	{
		$check = $check ? '1' : '0';
		DB::statement("SET FOREIGN_KEY_CHECKS = $check;");
	}

}
