<?php

namespace TeachMe\Repositories;

abstract class BaseRepository
{
    /**
    * @return \TeachMe\Entities\Model
    */
    abstract public function getModel();
    
    public function findOrFail($id)
    {
        return $this->newQuery()->findOrFail($id);
    }

    protected function newQuery()
    {
        return $this->getModel()->newQuery();
    }
}
