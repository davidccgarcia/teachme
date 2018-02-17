<?php

use TeachMe\Entities\Vote;
use Faker\Generator;

class VoteTableSeeder extends BaseSeeder
{
    public function run()
    {
        $this->createMultiple(250);
    }

    protected function getModel()
    {
        return new Vote();
    }

    protected function getDummyData(Generator $faker)
    {
        return [
            'user_id' => $this->random('User')->id, 
            'ticket_id' => $this->random('Ticket')->id, 
        ];
    }
}