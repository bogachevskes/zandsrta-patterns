<?php

namespace App\Visitor;

use App\Visitor\Reports\Base\ReportableBook;

class Requests extends ReportableBook
{
    protected string $bookName = 'Заявки';

    protected function getRows(): array
    {
        return [
            ['RC102234', 'Зерно', 'МЖД', 'Фасовка'],
            ['RC102456', 'Масло подсолнечное', 'БД', 'Налив'],
            ['RC102567', 'Шрот', 'ПД', 'Налив'],
            ['RC102234', 'Соя', 'МЖД', 'Фасовка'],
            ['RC102567', 'Гранулы', 'ПД', 'Фасовка'],
        ];
    }

}