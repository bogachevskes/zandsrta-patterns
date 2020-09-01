<?php

namespace App\Facade\Components;

use App\Facade\Components\Base\Checkable;

class CarDriver implements Checkable
{
    public function check(): string
    {
        return 'Car driver is checked';
    }
}