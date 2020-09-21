<?php

namespace App\Command\Commands\Base;

use App\Command\{
    CommandContext,
};

abstract class BaseCommand
{
    abstract public function execute(CommandContext $context): void;
}