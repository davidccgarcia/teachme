<?php

use Illuminate\Database\Seeder;
use TeachMe\Entities\User;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        $this->createAdmin();
    }

    public function createAdmin()
    {
        return User::create([
            'name' => 'David García', 
            'email' => 'ccristhiangarcia@gmail.com', 
            'password' => bcrypt('secret'), 
            'remember_token' => str_random(25)
        ]);
    }
}