<?php

namespace Future\Core\Http\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DataImport implements ToModel, WithHeadingRow
{
    private $rows = [];

    public function model(array $row)
    {
        $this->rows[] = $row;
    }

    public function getData(): array
    {
        return $this->rows;
    }
}
