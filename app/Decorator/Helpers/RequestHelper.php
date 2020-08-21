<?php

namespace App\Decorator\Helpers;

class RequestHelper
{
    public function __construct()
    {
        $this->printInfo();
    }

    private function printInfo()
    {
        echo '<br>Использование декоратора как middleware <br>';
    }
}