<?php

namespace App\Strategy\Base;

abstract class Lesson
{
    private $duration;
    private $costStrategy;

    public function __construct(int $duration, CostStrategy $costStrategy)
    {
        $this->duration     = $duration;
        $this->costStrategy = $costStrategy;
    }

    public function cost(): int
    {
        return $this->costStrategy->cost($this);
    }

    public function printCostInfo(): string
    {
        return 'Оплата за занятие ' . $this->cost();
    }

    public function chargeType(): string
    {
        return $this->costStrategy->chargeType();
    }

    public function printChargeType(): string
    {
        return 'Тип оплаты: ' . $this->chargeType();
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

}