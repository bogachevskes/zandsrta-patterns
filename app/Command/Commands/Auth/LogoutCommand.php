<?php

namespace App\Command\Commands\Auth;

use App\Command\{
    CommandContext,
    Commands\Base\BaseCommand,
};

class LogoutCommand extends BaseCommand
{
    public function execute(CommandContext $context): void
    {
        $login      = $context->get('login');
        $password   = $context->get('password');

        echo "Выполнен выход <br>";
        echo "Логин: $login <br>";
    }
}