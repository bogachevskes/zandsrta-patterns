<?php

namespace App\Facade\Components;

use App\Facade\Components\Base\Checkable;

class OperationSystem implements Checkable
{
    public function check(): string
    {
        return 'Operation system is ready';
    }
}