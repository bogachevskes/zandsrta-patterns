<?php

namespace App\Visitor;

use App\Visitor\Reports\Base\ReportableBook;

class Tenders extends ReportableBook
{
    protected string $bookName = 'Тендеры';

    protected function getRows(): array
    {
        return [
            'ООО Семена',
            'ООО Масло подсолнечное',
            'ООО Шрот',
        ];
    }
    
}