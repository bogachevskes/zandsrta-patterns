<?php

namespace App\Singleton;

class Preferences
{
    protected $props = [];

    protected static $instance;

    protected function __construct()
    {
        //
    }

    /**
     * нет возможности типизировать вывод,
     * т.к. php7.1, не корреткно понимает :self
     * в дочернем классе при наследовании.
     */
    public static function getInstance()
    {
        if (self::$instance instanceof self) {
            return self::$instance;
        }

        return self::$instance = new self;
    }

    public function setProperty(string $key, $value): self
    {
        $this->props[$key] = $value;
        
        return $this;
    }

    public function getProperty(string $key)
    {
        if (! isset($this->props[$key])) {
            throw new \Exception('Property not set');
        }

        return $this->props[$key];
    }

    public function printPropertyValue(string $key): string
    {
        return 'Значение параметра ' . $key . ' - ' . $this->getProperty($key);
    }
}