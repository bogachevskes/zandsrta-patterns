<?php

namespace App\Composite\Base;

abstract class CompositeProductUnit extends ProductUnit
{
    private $_units = [];
    
    public function addUnit(ProductUnit $unit): void
    {
        $this->_units[] = $unit;
    }

    public function addUnits(array $units): void
    {
        foreach ($units as $unit) {
            if (! $unit instanceof ProductUnit) {
                throw new UnitException('Элемент должен соотвтествовать классу ' . ProductUnit::class);
            }

            $this->addUnit($unit);
        }
    }

    public function removeUnit(ProductUnit $unit): void
    {
        $id = array_search($unit, $this->_units, true);

        if (is_int($id)) {
            array_splice($this->_units, $id, 1);
        }
    }

    public function getWeight(): int
    {
        $weight = 0;

        foreach ($this->_units as $chair) {
            $weight += $chair->getWeight();
        }

        return $weight;
    }
}