<?php

namespace App\Singleton;

class Preferences
{
    protected array $props = [];

    protected static $instance;

    protected function __construct()
    {
        //
    }

    public static function getInstance(): self
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