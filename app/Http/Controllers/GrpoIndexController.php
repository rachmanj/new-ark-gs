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
        $grpos = [];

        foreach ($projects as $project) {
            $po_sent_amount = $this->getPoSentAmount($project);
            $grpo_amount = $this->getGrpoAmount($project);

            $percentage = ($po_sent_amount == 0 || $grpo_amount == 0) ? 0 : $grpo_amount / $po_sent_amount;

            $grpos[] = [
                'project' => $project,
                'grpo_amount' => $grpo_amount,
                'po_sent_amount' => $po_sent_amount,
                'percentage' => $percentage
            ];
        }

        $total_grpo_amount = array_sum(array_column($grpos, 'grpo_amount'));
        $total_po_sent_amount = array_sum(array_column($grpos, 'po_sent_amount'));
        $total_percentage = ($total_grpo_amount == 0 || $total_po_sent_amount == 0) ? 0 : $total_grpo_amount / $total_po_sent_amount;

        return [
            'grpo_daily' => $grpos,
            'total_grpo_amount' => $total_grpo_amount,
            'total_po_sent_amount' => $total_po_sent_amount,
            'total_percentage' => $total_percentage
        ];
    }

    private function getPoSentAmount($project)
    {
        return app(CapexController::class)->po_sent_amount()
            ->where('project_code', $project)
            ->sum('item_amount');
    }

    private function getGrpoAmount($project)
    {
        $date = Carbon::now()->subDay();
        $excl_itemcode_arr = array_map(function ($e) {
            return ['item_code', 'not like', $e];
        }, ['EX%', 'FU%', 'PB%', 'Pp%', 'SA%', 'SO%', 'SV%']);

        return Grpo::whereMonth('po_delivery_date', $date->month)
            ->whereYear('po_delivery_date', $date->year)
            ->whereMonth('grpo_date', $date->month)
            ->whereYear('grpo_date', $date->year)
            ->where('po_delivery_status', 'Delivered')
            ->where('project_code', $project)
            ->whereIn('dept_code', ['40', '50', '60', '140', '200'])
            ->where(function ($query) use ($excl_itemcode_arr) {
                foreach ($excl_itemcode_arr as $condition) {
                    $query->where($condition[0], $condition[1], $condition[2]);
                }
            })
            ->sum('item_amount');
    }
}
