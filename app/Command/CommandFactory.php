<?php

namespace App\Command;

use App\Command\{
    CommandContext,
    CommandFactoryException,
    Commands\Base\BaseCommand,
};

class CommandFactory extends BaseCommand
{
    const NAMESPACE_DIR = 'App\\Command\\Commands\\';

    const BASE_PREFIX = 'Command';
    
    protected BaseCommand $command;
    
    public function __construct(string $action)
    {
        $this->defineCommand($action);
    }

    public function getNamespace(string $action)
    {
        return static::NAMESPACE_DIR . ucfirst($action) . static::BASE_PREFIX;
    }

    public function defineCommand(string $action)
    {
        $class = $this->getNamespace($action);

        if (! class_exists($class)) {
            throw new CommandFactoryException('Команда не найдена');
        }

        $this->command = new $class;
    }

    public function execute(CommandContext $context): void
    {
        $this->command->execute($context);
    }

}
