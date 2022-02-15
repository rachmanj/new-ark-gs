<?php

namespace App\Exports;

use App\Models\Grpo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GrpoExportThisYear implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
            '#',
            'po_no',
            'po_date',
            'po_delivery_date',
            'po_delivery_status',
            'grpo_no',
            'grpo_date',
            'vendor_code',
            'item_code',
            'description',
            'uom',
            'qty',
            'unit_no',
            'project_code',
            'dept_code',
            'grpo_currency',
            'unit_price',
            'item_amount',
            'remarks',
            'created_at',
            'updated_at',
        ];
    }

    public function collection()
    {
        return Grpo::all();
    }
}

