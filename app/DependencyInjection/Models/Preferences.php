<?php

namespace App\DependencyInjection\Models;

use App\DependencyInjection\Base\ConfigurableInstance;

use App\Singleton\Preferences as NotImplementedPreferences;

class Preferences extends NotImplementedPreferences implements ConfigurableInstance
{
    public static function getInstance(): self
    {
        if (self::$instance instanceof self) {
            return self::$instance;
        }

        return self::$instance = new self;
    }
}