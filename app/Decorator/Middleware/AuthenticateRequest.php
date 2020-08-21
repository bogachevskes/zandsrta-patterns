<?php

namespace App\Decorator\Middleware;

use App\Decorator\Helpers\RequestHelper;
use App\Decorator\Base\DecorateProcess;

class AuthenticateRequest extends DecorateProcess
{
    public function process(RequestHelper $request): void
    {
        $this->printInfo();
        $this->_processRequest->process($request);
    }

    protected function getInfo(): string
    {
        return 'аутентификация запроса';
    }
}