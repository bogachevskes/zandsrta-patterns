<?php

namespace App\NullObject\Base;

class Entity
{
    protected string $id;

    protected string $name;
    
    public function __construct(string $id = '', string $name = '(не указано)')
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}