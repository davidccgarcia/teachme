<?php

use TeachMe\Entities\User;
use Faker\Generator;

class UserTableSeeder extends BaseSeeder
{
    public function run()
    {
        $this->createAdmin();
        $this->createMultiple(49);
    }

    protected function getModel()
    {
        return new User;
    }

    protected function getDummyData(Generator $faker)
    {
        return [
            'name' => $faker->name, 
            'email' => $faker->email,
            'password' => bcrypt('secret'), 
            'remember_token' => str_random(25)
        ];
    }

    protected function createAdmin()
    {
        $this->create([
            'name' => 'David García', 
            'email' => 'ccristhiangarcia@gmail.com', 
            'password' => bcrypt('secret'), 
            'remember_token' => str_random(25)
        ]);
    }
}
