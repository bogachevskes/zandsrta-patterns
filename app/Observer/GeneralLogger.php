<?php

namespace App\Observer;

use App\Observer\{
    Loggin,
    Base\LogginObserver,
};

class GeneralLogger extends LogginObserver
{
    protected function doUpdate(Loggin $login): void
    {
        echo 'Поптыка входа<br>';
        echo 'Логин: ' . $login->getLogin() . '<br>';
        echo 'Пароль: ' . $login->getPassword() . '<br>';
        echo 'IP: ' . $login->getIp() . '<br>';
        echo 'Статус: ' . $this->printStatusName($login->getStatusCode()) . '<br>';
    }

    protected function printStatusName(int $statusName): string
    {
        switch ($statusName) {
            case Loggin::STATUS_CODE_LOGGED:
                return 'Вход выполнен';
            case Loggin::STATUS_CODE_FAILED:
                return 'Ошибка аутентификации';
            case Loggin::STATUS_CODE_BLOCKED:
                return 'Пользователь заблокирован';
        }
    
        return 'Код не определен';
    }
}