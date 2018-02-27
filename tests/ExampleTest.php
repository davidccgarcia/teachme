<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase {

	use DatabaseTransactions;
	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testBasicExample()
	{
		// Having
		$user = seed('User');
		
		// When
		$this->actingAs($user)
			->visit('/')

		// Then
			->see('Solicitudes recientes');
	}

}
