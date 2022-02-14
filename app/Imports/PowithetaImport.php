<?php

namespace App\Imports;

use App\Models\Powitheta;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PowithetaImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Powitheta([
            'po_no' => $row['po_no'],
            'create_date' => $row['create_date'],
            'posting_date' => $row['posting_date'],
            'vendor_code' => $row['vendor_code'],
            'unit_no' => $row['unit_no'],
            'item_code' => $row['item_code'],
            'uom' => $row['uom'],
            'description' => $row['description'],
            'qty' => $row['qty'],
            'unit_price' => $row['unit_price'],
            'project_code' => $row['project_code'],
            'dept_code' => $row['dept_code'],
            'po_currency' => $row['po_currency'],
            'item_amount' => $row['item_amount'],
            'total_po_price' => $row['total_po_price'],
            'po_with_vat' => $row['po_with_vat'],
            'po_status' => $row['po_status'],
            'po_delivery_status' => $row['po_delivery_status'],
            'po_delivery_date' => $row['po_delivery_date'],
            'po_eta' => $row['po_eta'],
        ]);
    }
}
