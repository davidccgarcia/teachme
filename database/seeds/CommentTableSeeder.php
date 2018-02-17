<?php

use TeachMe\Entities\Comment;
use Faker\Generator;

class CommentTableSeeder extends BaseSeeder
{
    public function run()
    {
        $this->createMultiple(50);
    }

    protected function getModel()
    {
        return new Comment();
    }

    protected function getDummyData(Generator $faker)
    {
        return [
            'comment' => $faker->sentence(), 
            'link' => $faker->url(), 
            'user_id' => $this->random('User')->id, 
            'ticket_id' => $this->random('Ticket')->id, 
        ];
    }
}