<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public $include_projects = ['011C', '017C', '021C', '022C', '023C', 'APS'];

    public function index()
    {
        $test = app(CapexController::class)->capex_daily();
        return $test;
    }

    public function capex_daily()
    {
        $projects = $this->include_projects;
        
        foreach ($projects as $project) {
            $budget = $this->plant_budget()->where('project_code', $project)
                    ->where('budget_type_id', 8)
                    ->sum('amount');

            $po_sent_amount = $this->po_sent_amount()->where('project_code', $project)
                            ->where('budget_type', 'CPX')
                            ->sum('item_amount');

            // percentage of capex budget vs sent amount, if budget or sent amount is null
            if ($budget == 0 || $po_sent_amount == 0) {
                $percentage = 0;
            } else {
                $percentage = $budget / $po_sent_amount;
            }

            $capex[] = [
                'project' => $project,
                'capex_budget' => $budget,
                'capex_sent_amount' => $po_sent_amount,
                'percentage' => $percentage
            ];
            
        };

        return $capex;
    }

    public function regular_daily()
    {
        $excl_budget_types = ['CPX']; // , 
        foreach ($excl_budget_types as $e) {
            $excl_budget_types_arr[] = ['budget_type', 'not like', $e];
        };

        $projects = $this->include_projects;
        
        foreach ($projects as $project) {
            $budget = $this->plant_budget()->where('project_code', $project)
                    ->where('budget_type_id', 2)
                    ->sum('amount');

            $pos = $this->po_sent_amount()->where('project_code', $project);

            $po_sent_amount = $pos->where(function ($query) {
                $query->whereNull('powithetas.budget_type')
                      ->orWhere('powithetas.budget_type', 'REG');
                    })->sum('powithetas.item_amount');

            $reguler[] = [
                'project' => $project,
                'reguler_budget' => $budget,
                'reguler_sent_amount' => $po_sent_amount
            ];
            
        };

        return $reguler;
    }

    public function plant_budget()
    {
        $date = Carbon::now()->subDay();
        return Budget::select('project_code', 'amount', 'budget_type_id')
            ->whereYear('date', $date)
            ->whereMonth('date', $date);
    }

    public function po_sent_amount()
    {
        $date = Carbon::now()->subDay();
        $incl_deptcode = ['40', '50', '60', '140'];
        $projects = $this->include_projects;

        $excl_itemcode = ['EX%', 'FU%', 'PB%', 'Pp%', 'SA%', 'SO%', 'SV%']; // , 
        foreach ($excl_itemcode as $e) {
            $excl_itemcode_arr[] = ['item_code', 'not like', $e];
        };

        $list = DB::table('powithetas')
            ->whereIn('dept_code', $incl_deptcode)
            ->where($excl_itemcode_arr)
            ->whereMonth('po_delivery_date', $date)
            ->where('po_status', '!=', 'Cancelled')
            ->where('po_delivery_status', 'Delivered');
            
        return $list;
    }

}
