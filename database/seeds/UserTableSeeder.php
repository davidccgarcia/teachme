<?php

use TeachMe\Entities\User;
use Styde\Seeder\Seeder;
use Faker\Generator;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        $this->createAdmin();
        $this->createMultiple(49);
    }

    public function getModel()
    {
        return new User;
    }

    public function getDummyData(Generator $faker, array $customValues = [])
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
