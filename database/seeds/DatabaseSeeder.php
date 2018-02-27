<?php

use Styde\Seeder\BaseSeeder;

class DatabaseSeeder extends BaseSeeder {

	protected $truncate = [
		'users', 'tickets', 'votes', 'comments', 'password_resets'
	];

	protected $seeders = [
		'User', 'Ticket', 'Vote', 'Comment', 
	];

}
