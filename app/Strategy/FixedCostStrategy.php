<?php

namespace App\Strategy;

use App\Strategy\Base\CostStrategy;
use App\Strategy\Base\Lesson;

class FixedCostStrategy extends CostStrategy
{
    public function cost(Lesson $lesson): int
    {
        return ($lesson->getDuration() * 3);
    }

    public function chargeType(): string
    {
        return 'Фиксированная ставка';
    }
}