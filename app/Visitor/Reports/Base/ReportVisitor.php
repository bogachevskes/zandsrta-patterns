<?php

namespace App\Visitor\Reports\Base;

use App\Visitor\{
    Requests,
    Tenders
};

use ReflectionClass;

abstract class ReportVisitor
{
    private function getMethodName(ReportableBook $book): string
    {
        $calledClass = new ReflectionClass(get_class($book));

        return 'visit' . $calledClass->getShortName() . 'AndReport';
    }
    
    public function visit(ReportableBook $book, ...$args): void
    {
        $methodName = $this->getMethodName($book);

        $this->{$methodName}($book, $args);
    }
    
    abstract public function visitRequestsAndReport(Requests $entity): void;

    abstract public function visitTendersAndReport(Tenders $entity): void;
}