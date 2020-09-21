<?php

namespace App\Command\Commands;

use App\Command\{
    Commands\Base\BaseCommand,
    Commands\Auth\AuthException,
    Commands\Auth\LoginCommand,
    Commands\Auth\LogoutCommand,
    CommandContext,
};

class AuthCommand extends BaseCommand
{
    const TYPE_LOGIN = 'login';

    const TYPE_LOGOUT = 'logout';
    
    protected CommandContext $context;

    protected BaseCommand $command;
    
    protected function defineActionType()
    {
        $action = $this->context->get('type');
        
        switch ($action) {
            case static::TYPE_LOGIN:
                $this->command = new LoginCommand;
                break;
            case static::TYPE_LOGOUT:
                $this->command = new LogoutCommand;
                break;
            default:
                throw new AuthException('Команда аутентификации не определена');
        }
    }
    
    public function execute(CommandContext $context): void
    {
        $this->context = $context;
        
        $this->defineActionType();

        $this->command->execute($this->context);
    }
}