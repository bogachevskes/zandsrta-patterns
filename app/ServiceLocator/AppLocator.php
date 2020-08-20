<?php

namespace App\ServiceLocator;

use App\Singleton\Preferences;

class AppLocator
{
    const PREFERENСES = 'preferences';
    
    function __get(string $service) {
        switch ($service) {
            case self::PREFERENСES:
                return Preferences::getInstance();
            default:
                throw new \Exception('Service not found');
        }
    }
}