<?php
namespace Future\Core\Http\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataExport implements FromCollection, WithHeadings
{
    private Collection $data;
    private array $headings;

    public function __construct(Collection $data, array $headings = [])
    {
        $this->data = $data;
        $this->headings = $headings;
    }

    public function collection(): Collection
    {
        return $this->data;
    }

    public function headings(): array
    {
        return $this->headings;
    }
}
