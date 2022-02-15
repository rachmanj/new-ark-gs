<?php

namespace App\Exports;

use App\Models\Incoming;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class IncomingExport implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
            '#',
            'posting_date',
            'document_type',
            'document_no',
            'project',
            'dept_code',
            'item_code',
            'qty',
            'uom',
            'created_at',
            'updated_at',
        ];
    }

    public function collection()
    {
        return Incoming::whereMonth('posting_date', Carbon::now())->get();
    }
}
