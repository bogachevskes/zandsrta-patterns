<?php

namespace App\Visitor\Reports;

use App\Visitor\{
    Reports\Base\ReportVisitor,
    Requests,
    Tenders,
};

class ReportTypeA extends ReportVisitor
{
    public function visitRequestsAndReport(Requests $entity): void
    {
        echo 'Отчет раздела ' . $entity->getBookName() . '<br>';
        echo 'Всего заявок: ' . $entity->getTotalRowsCount() . '<br>';
        echo $entity->printRows() . '<br>';
    }

    public function visitTendersAndReport(Tenders $entity): void
    {
        echo 'Отчет раздела ' . $entity->getBookName() . '<br>';
        echo 'Всего тендеров: ' . $entity->getTotalRowsCount() . '<br>';
        echo $entity->printRows() . '<br>';
    }

}