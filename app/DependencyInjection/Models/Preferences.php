<?php

namespace App\DependencyInjection\Models;

use App\Singleton\Base\BasePreferences;
use App\DependencyInjection\Base\ConfigurableInstance;
use App\Singleton\Preferences as NotImplementedPreferences;

class Preferences extends NotImplementedPreferences implements ConfigurableInstance, BasePreferences
{
    public static function getInstance(): BasePreferences
    {
        if (self::$instance instanceof self) {
            return self::$instance;
        }

        return self::$instance = new self;
    }
}