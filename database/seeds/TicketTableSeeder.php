<?php

use TeachMe\Entities\Ticket;
use Faker\Generator;

class TicketTableSeeder extends BaseSeeder
{
    public function run()
    {
        $this->createMultiple(50);
    }

    protected function getModel()
    {
        return new Ticket;
    }

    protected function getDummyData(Generator $faker)
    {
        return [
            'title' => $faker->sentence(), 
            'status' => $faker->randomElement(['open', 'open', 'closed']), 
            'user_id' => $this->random('User')->id, 
        ];
    }
}
