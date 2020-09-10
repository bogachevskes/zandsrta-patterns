<?php

namespace App\Visitor\Reports\Base;

abstract class ReportableBook
{
    protected string $bookName = 'Общий раздел';

    abstract protected function getRows(): array;

    public function acceptReport(ReportVisitor $visitor): void
    {
        $visitor->visit($this);
    }

    public function getBookName(): string
    {
        return $this->bookName;
    }

    public function getTotalRowsCount(): string
    {
        return count($this->getRows());
    }

    public function printRows(): string
    {
        $rows = $this->getRows();

        $row = '';
        
        foreach ($rows as $rowData) {
            
            if (is_array($rowData)) {
                $row .= implode(' | ', $rowData) . '<br>';

                continue;
            }
            
            $row .= $rowData . '<br>';
        }

        return $row;
    }

}