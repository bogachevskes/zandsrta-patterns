<?php

namespace App\NullObject;

use App\NullObject\Base\Entity;

class CombinedEntity extends Entity
{
    protected Entity $subEntity;
    
    public function __construct(string $id = '', string $name = '(не указано)', ?Entity $subEntity = null)
    {
        parent::__construct($id, $name);
        
        $this->defineSubEntity($subEntity);
    }

    protected function defineSubEntity(?Entity $subEntity): void
    {
        if (! $subEntity instanceof Entity) {
            $this->subEntity = new Entity;

            return;
        }

        $this->subEntity = $subEntity;
    }

    public function getSubEntityName(): string
    {
        return $this->subEntity->getName();
    }

}