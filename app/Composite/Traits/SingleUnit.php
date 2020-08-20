<?php

namespace App\Composite\Traits;

trait SingleUnit
{
    private $_weight = 0;

    public function __construct(int $weight)
    {
        $this->_weight = $weight;
    }
}