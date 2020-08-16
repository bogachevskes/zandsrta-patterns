<?php

namespace App\Strategy;

use App\Strategy\Base\CostStrategy;
use App\Strategy\Base\Lesson;

class TimedCostStrategy extends CostStrategy
{
    public function cost(Lesson $lesson): int
    {
        return ($lesson->getDuration() * 5);
    }

    public function chargeType(): string
    {
        return 'Почасовая оплата';
    }
}