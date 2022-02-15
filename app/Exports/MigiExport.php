<?php

namespace App\Exports;

use App\Models\Migi;
use Maatwebsite\Excel\Concerns\FromCollection;

class MigiExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Migi::all();
    }
}
