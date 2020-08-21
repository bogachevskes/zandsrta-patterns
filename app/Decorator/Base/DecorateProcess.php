<?php

namespace App\Decorator\Base;

use App\Decorator\Helpers\RequestHelper;

abstract class DecorateProcess extends ProcessRequest
{
    protected $_processRequest;
    
    public function __construct(ProcessRequest $processRequest)
    {
        $this->_processRequest = $processRequest;
    }
}