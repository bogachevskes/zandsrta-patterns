<?php

namespace App\Decorator;

use App\Decorator\Base\ProcessRequest;
use App\Decorator\Helpers\RequestHelper;

class MainProcess extends ProcessRequest
{
    public function process(RequestHelper $request): void
    {
        $this->printInfo();
    }

    protected function getInfo(): string
    {
        return 'Обработка запроса';
    }
}