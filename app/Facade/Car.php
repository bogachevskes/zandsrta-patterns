<?php

namespace App\Facade;

use App\Facade\Components\{
    CarDriver,
    FuelControl,
    Engine,
    OperationSystem,
    Base\CarSystemCheckException,
    Base\Checkable,
};

class Car
{
    private Checkable $carDriver;

    private Checkable $engine;

    private Checkable $operationSystem;

    private Checkable $fuelControl;
    
    public function __construct(CarDriver $carDriver, int $fuelLevel = 50)
    {
        $this->carDriver = $carDriver;
        $this->fuelControl = new FuelControl($fuelLevel);
        $this->operationSystem = new OperationSystem;
        $this->engine = new Engine;
    }

    private function checkAllSystems(): void
    {
        echo $this->carDriver->check() . '<br>';
        echo $this->operationSystem->check() . '<br>';
        echo $this->engine->check() . '<br>';
        echo $this->fuelControl->check() . '<br>';
    }

    public function checkEngine(): void
    {
        try {

            $this->checkAllSystems();

        } catch (CarSystemCheckException $e) {
            echo 'Something went wrong when trying to engine start. Error message: <b>' . $e->getMessage() . '</b>';

            return;
        }
        

        echo 'Engine ready to start';
    }
}