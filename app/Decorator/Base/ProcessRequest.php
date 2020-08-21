<?php

namespace App\Decorator\Base;

use App\Decorator\Helpers\RequestHelper;

abstract class ProcessRequest
{

    
    abstract public function process(RequestHelper $request): void;

    abstract protected function getInfo(): string;

    protected function printInfo(): void
    {
        print static::class . ': ' . $this->getInfo() . '. <br>';
    }
}