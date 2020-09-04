<?php

namespace App\Observer\Base;

use App\Observer\Loggin;

abstract class LogginObserver implements \SplObserver
{
    private Loggin $login;

    public function __construct(Loggin $login)
    {
        $this->login = $login;
        $this->login->attach($this);
    }

    public function update(\SplSubject $subject): void
    {
        if ($subject === $this->login) {
            $this->doUpdate($subject);
        }
    }

    abstract protected function doUpdate(Loggin $login): void;
}