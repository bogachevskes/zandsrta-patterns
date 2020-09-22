<?php

namespace App\Command;

class CommandContext
{
    protected array $params = [];

    protected array $errors = [];

    public function set(string $key, $value): void
    {
        $this->params[$key] = $value;
    }

    public function get(string $key)
    {
        if (isset($this->params[$key])) {
            return $this->params[$key];
        }

        return null;
    }

    public function setError(string $key, $value): void
    {
        $this->errors[$key] = $value;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

}
