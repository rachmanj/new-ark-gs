<?php

namespace App\Http\Controllers;

use App\Models\Grpo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GrpoIndexController extends Controller
{
    public $include_projects = ['017C', '021C', '022C', '023C', 'APS'];

    public function index()
    {
        $projects = $this->include_projects;
        
        foreach ($projects as $project) {
            $po_sent_amount = app(CapexController::class)->po_sent_amount()->where('project_code', $project)
                            ->sum('item_amount');
            
            $grpo_amount = $this->grpo_amount()->where('project_code', $project)
                        ->sum('item_amount');

            // percentage of capex budget vs sent amount, if budget or sent amount is null
            if ($po_sent_amount == 0 || $grpo_amount == 0) {
                $percentage = 0;
            } else {
                $percentage = $grpo_amount / $po_sent_amount;
            }

            $grpos[] = [
                'project' => $project,
                'grpo_amount' => $grpo_amount,
                'po_sent_amount' => $po_sent_amount,
                'percentage' => $percentage
            ];
        };

        $total_grpo_amount = array_sum(array_column($grpos, 'grpo_amount'));
        $total_po_sent_amount = array_sum(array_column($grpos, 'po_sent_amount'));

        // percentage of capex budget vs sent amount, if budget or sent amount is null
        if ($total_grpo_amount == 0 || $total_po_sent_amount == 0) {
            $total_percentage = 0;
        } else {
            $total_percentage = $total_grpo_amount / $total_po_sent_amount;
        }
        
        $result = [
            'grpo_daily' => $grpos,
            'total_grpo_amount' => $total_grpo_amount,
            'total_po_sent_amount' => $total_po_sent_amount,
            'total_percentage' => $total_percentage
        ];

        return $result;
    }

    public function grpo_amount()
    {
        $date = Carbon::now()->subDay();
        $projects = $this->include_projects;
        $incl_deptcode = ['40', '50', '60', '140'];
        $excl_itemcode = ['EX%', 'FU%', 'PB%', 'Pp%', 'SA%', 'SO%', 'SV%']; // , 
        foreach ($excl_itemcode as $e) {
            $excl_itemcode_arr[] = ['item_code', 'not like', $e];
        };

        $list = Grpo::whereMonth('po_delivery_date', $date)
            ->whereMonth('grpo_date', $date)
            ->where('po_delivery_status', 'Delivered')
            ->whereIn('project_code', $projects)
            ->whereIn('dept_code', $incl_deptcode)
            ->where($excl_itemcode_arr);

        return $list;
    }
}
