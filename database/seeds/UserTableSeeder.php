<?php

use Illuminate\Database\Seeder;
use TeachMe\Entities\User;
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        $this->createAdmin();
        $this->createUsers();
    }

    protected function createAdmin()
    {
        return User::create([
            'name' => 'David García', 
            'email' => 'ccristhiangarcia@gmail.com', 
            'password' => bcrypt('secret'), 
            'remember_token' => str_random(25)
        ]);
    }

    protected function createUsers()
    {
        $faker = Faker::create();

        for ($i = 1; $i < 50; $i++) { 
            User::create([
                'name' => $faker->name, 
                'email' => $faker->email,
                'password' => bcrypt('secret'), 
                'remember_token' => str_random(25)
            ]);
        }
    }
}