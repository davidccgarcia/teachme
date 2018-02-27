<?php

use TeachMe\Entities\Comment;
use Styde\Seeder\Seeder;
use Faker\Generator;

class CommentTableSeeder extends Seeder
{
    public function run()
    {
        $this->createMultiple(50);
    }

    public function getModel()
    {
        return new Comment();
    }

    public function getDummyData(Generator $faker, array $customValues = [])
    {
        return [
            'comment' => $faker->sentence(), 
            'link' => $faker->url(), 
            'user_id' => $this->random('User')->id, 
            'ticket_id' => $this->random('Ticket')->id, 
        ];
    }
}