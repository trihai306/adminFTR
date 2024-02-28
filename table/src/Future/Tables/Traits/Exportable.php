<?php

namespace Future\Table\Future\Tables\Traits;

use Barryvdh\DomPDF\Facade\Pdf;
use Future\Core\Http\Exports\DataExport;
use Maatwebsite\Excel\Facades\Excel;


trait Exportable
{
    public $type = 'excel';
    /**
     * Export data to Excel.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    protected function exportExcel()
    {
        $data = $this->applyTableQuery()->paginate($this->perPage);
        $headings = array_map(function ($column) {
            return $column->label;
        }, $this->defineColumns());
        return Excel::download(new DataExport($data, $headings), 'data.xlsx');
    }
    /**
     * Export data to CSV.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    protected function exportCsv()
    {
        $data = $this->applyTableQuery()->get();
        $headings = array_map(function ($column) {
            return $column->label;
        }, $this->defineColumns());
        return Excel::download(new DataExport($data, $headings), 'data.csv');
    }
    /**
     * Export data to PDF.
     *
     * @return \Illuminate\Http\Response
     */
    protected function exportPdf()
    {
        $data = $this->applyTableQuery()->get();
        $headings = array_map(function ($column) {
            return $column->label;
        }, $this->defineColumns());
        $pdf = PDF::loadView('', compact('data', 'headings'));
        return $pdf->download('data.pdf');
    }

    public function export()
    {
        if ($this->type == 'excel') {
            return $this->exportExcel();
        } elseif ($this->type == 'csv') {
            return $this->exportCsv();
        } elseif ($this->type == 'pdf') {
            return $this->exportPdf();
        }
    }
}
