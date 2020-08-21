<?php

namespace App\Composite;

use App\Composite\Base\ProductUnit;
use App\Composite\Traits\SingleUnit;

class Chair extends ProductUnit
{
    use SingleUnit;

    public function getWeight(): int
    {
        return $this->_weight;
    }
}