<?php

namespace App\Command\Commands\Auth;

use App\Command\{
    CommandContext,
    Commands\Base\BaseCommand,
};

class LoginCommand extends BaseCommand
{
    public function execute(CommandContext $context): void
    {
        $login      = $context->get('login');
        $password   = $context->get('password');

        echo "Выполнен вход <br>";
        echo "Логин: $login <br>";
        echo "Пароль: $password <br>";
    }
}