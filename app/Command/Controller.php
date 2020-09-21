<?php

namespace App\Command;

class Controller
{
    protected CommandContext $context;

    public function __construct()
    {
        $this->context = new CommandContext;
    }

    public function getContext(): CommandContext
    {
        return $this->context;
    }

    public function process()
    {
        $action = $this->context->get('action');
        
        $cmd = new CommandFactory($action);
        
        $cmd->execute($this->context);
    }
}