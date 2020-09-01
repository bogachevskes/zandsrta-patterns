<?php

namespace App\Facade\Components;

use App\Facade\Components\Base\{
    Checkable,
    CarSystemCheckException,
};

class FuelControl implements Checkable
{
    const MIN_FUEL_LEVEL = 70;
    
    private $fuelLevel;
    
    public function __construct(int $fuelLevel)
    {
        $this->fuelLevel = $fuelLevel;
    }
    
    public function check(): string
    {
        if ($this->fuelLevel < static::MIN_FUEL_LEVEL) {
            throw new CarSystemCheckException('Min fuel level must be higher or equal to ' . static::MIN_FUEL_LEVEL);
        }

        return 'Fuel check completed';
    }
}