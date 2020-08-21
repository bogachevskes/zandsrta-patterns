<?php

namespace App\Composite\Base;

abstract class ProductUnit
{
    abstract public function getWeight(): int;

    public function printWeight(): string
    {
        return 'Общий вес: ' . $this->getWeight() . ' кг.';
    }
}