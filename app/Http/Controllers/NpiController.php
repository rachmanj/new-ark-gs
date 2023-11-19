<?php

namespace App\Http\Controllers;

use App\Models\Incoming;
use App\Models\Migi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NpiController extends Controller
{
    public $include_projects = ['017C', '021C', '022C', '023C', 'APS'];

    public function index()
    {
        $projects = $this->include_projects;

        foreach ($projects as $project) {
           $incoming_qty = $this->incomings()->where('project_code', $project)
                            ->sum('qty');
        
            $outgoing_qty = $this->outgoing()->where('project_code', $project)
                            ->sum('qty');

            // percentage of incoming qty vs outgoing qty, if incoming qty or outgoing qty is null
            if ($incoming_qty == 0 || $outgoing_qty == 0) {
                $percentage = 0;
            } else {
                $percentage = $incoming_qty / $outgoing_qty;
            }
            

            $npi[] = [
                'project' => $project,
                'incoming_qty' => $incoming_qty,
                'outgoing_qty' => $outgoing_qty,
                'percentage' => $percentage
            ];

        };

        $total_incoming_qty = array_sum(array_column($npi, 'incoming_qty'));
        $total_outgoing_qty = array_sum(array_column($npi, 'outgoing_qty'));

       // percentage of total incoming qty vs total outgoing qty, if incoming qty or outgoing qty is null
        if ($total_incoming_qty == 0 || $total_outgoing_qty == 0) {
            $percentage = 0;
        } else {
            $percentage = $total_incoming_qty / $total_outgoing_qty;
        }

        $result = [
            'npi' => $npi,
            'total_incoming_qty' => $total_incoming_qty,
            'total_outgoing_qty' => $total_outgoing_qty,
            'total_percentage' => $percentage
        ];

        return $result;
    }

    public function incomings()
    {
        $date = Carbon::now()->subDay();

        $incl_deptcode = ['40', '50', '60', '140'];

        $excl_itemcode = ['CO%', 'EX%', 'FU%', 'PB%', 'Pp%', 'SA%', 'SO%', 'SV%']; // , 
        foreach ($excl_itemcode as $e) {
            $excl_itemcode_arr[] = ['item_code', 'not like', $e];
        };

        $list = Incoming::whereMonth('posting_date', $date)
                ->whereYear('posting_date', $date)
                ->whereIn('dept_code', $incl_deptcode)
                ->where($excl_itemcode_arr)
                ->get();

        return $list;
    }

    public function outgoing()
    {
        $date = Carbon::now()->subDay();
        $incl_deptcode = ['40', '50', '60', '140'];

        $excl_itemcode = ['CO%', 'EX%', 'FU%', 'PB%', 'Pp%', 'SA%', 'SO%', 'SV%']; // , 
        foreach ($excl_itemcode as $e) {
            $excl_itemcode_arr[] = ['item_code', 'not like', $e];
        };

        $list = Migi::whereMonth('posting_date', $date)
                ->whereYear('posting_date', $date)
                ->whereIn('dept_code', $incl_deptcode)
                ->where($excl_itemcode_arr)
                ->get();

        return $list; 
    }
}
