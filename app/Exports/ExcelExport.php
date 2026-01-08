<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExcelExport implements FromCollection, WithHeadings
{
    protected $columns;
    protected $data;

    public function __construct(array $columns, array $data)
    {
        $this->columns = $columns;
        $this->data = $data;
    }

    public function collection()
    {
        return collect($this->data);
    }

    public function headings(): array
    {
        return array_keys($this->columns);
    }
}

