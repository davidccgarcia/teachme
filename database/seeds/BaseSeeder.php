<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Faker\Generator;

abstract class BaseSeeder extends Seeder
{
    protected function createMultiple($total, array $customValues = [])
    {
        for ($i = 1; $i <= $total; $i++) { 
            $this->create($customValues);
        }
    }

    abstract protected function getModel();

    abstract protected function getDummyData(Generator $faker);

    protected function create(array $customValues = [])
    {
        $value = $this->getDummyData(Faker::create());
        $value = array_merge($value, $customValues);
        $this->getModel()->create($value);
    }
}
