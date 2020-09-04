<?php

namespace App\Observer;

class Loggin implements \SplSubject
{
    const STATUS_CODE_LOGGED = 1;

    const STATUS_CODE_FAILED = 2;

    const STATUS_CODE_BLOCKED = 3;
    
    private string $login;

    private string $password;

    private int $statusCode;
    
    private \SplObjectStorage $storage;

    public function __construct(string $login, string $password)
    {
        $this->login    = $login;
        $this->password = $password;

        $this->storage = new \SplObjectStorage();
    }

    public function handle(): void
    {
        $this->statusCode = rand(self::STATUS_CODE_LOGGED, self::STATUS_CODE_BLOCKED);
        $this->notify();

    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getIp(): string
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

    public function attach(\SplObserver $observer): void
    {
        $this->storage->attach($observer);
    }

    public function detach(\SplObserver $observer): void
    {
        $this->storage->detach($observer);
    }
    
    public function notify(): void
    {
        foreach ($this->storage as $observer) {
            $observer->update($this);
        }
    }

}