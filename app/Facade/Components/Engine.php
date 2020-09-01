<?php

namespace App\Facade\Components;

use App\Facade\Components\Base\Checkable;

class Engine implements Checkable
{
    public function check(): string
    {
        return 'Engine is ready';
    }
}