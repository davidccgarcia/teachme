<?php

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Faker\Generator;

abstract class BaseSeeder extends Seeder
{
    protected static $pool = [];

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
        return $this->addToPool($this->getModel()->create($value));
    }

    protected function createFrom($seeder, array $customValues = [])
    {
        $seeder = new $seeder();
        return $seeder->create($customValues);
    }

    protected function random($model)
    {
        if (! $this->collectionExists($model)) {
            throw new Exception("The [$model] collection does not exist");
        }

        return static::$pool[$model]->random();
    }

    private function addToPool($model)
    {
        $reflection = new ReflectionClass($model);
        $class = $reflection->getShortName();

        if (! $this->collectionExists($class)) {
            static::$pool[$class] = new Collection();
        }

        static::$pool[$class]->add($model);

        return $model;
    }

    private function collectionExists($class)
    {
        return isset(static::$pool[$class]);
    }
}
