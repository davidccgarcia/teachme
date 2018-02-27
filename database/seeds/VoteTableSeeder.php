<?php

use TeachMe\Entities\Vote;
use Styde\Seeder\Seeder;
use Faker\Generator;

class VoteTableSeeder extends Seeder
{
    public function run()
    {
        $this->createMultiple(250);
    }

    public function getModel()
    {
        return new Vote();
    }

    public function getDummyData(Generator $faker, array $customValues = [])
    {
        return [
            'user_id' => $this->random('User')->id, 
            'ticket_id' => $this->random('Ticket')->id, 
        ];
    }
}