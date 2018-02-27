<?php

use TeachMe\Entities\Ticket;
use Styde\Seeder\Seeder;
use Faker\Generator;

class TicketTableSeeder extends Seeder
{
    public function run()
    {
        $this->createMultiple(50);
    }

    public function getModel()
    {
        return new Ticket;
    }

    public function getDummyData(Generator $faker, array $customValues = [])
    {
        return [
            'title' => $faker->sentence(), 
            'status' => $faker->randomElement(['open', 'open', 'closed']), 
            'user_id' => $this->random('User')->id, 
        ];
    }
}
