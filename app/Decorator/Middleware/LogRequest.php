<?php

namespace App\Decorator\Middleware;

use App\Decorator\Helpers\RequestHelper;
use App\Decorator\Base\DecorateProcess;

class LogRequest extends DecorateProcess
{
    public function process(RequestHelper $request): void
    {
        $this->printInfo();
        $this->_processRequest->process($request);
    }

    protected function getInfo(): string
    {
        return 'логирование запроса в журнале - ваш IP: ' . $this->getIp();
    }

    private function getIp(): string
    {
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        }
        
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }

        if (isset($_SERVER['REMOTE_ADDR'])) {
            return $_SERVER['REMOTE_ADDR'];
        }

        return 'не установлен';
    }
}