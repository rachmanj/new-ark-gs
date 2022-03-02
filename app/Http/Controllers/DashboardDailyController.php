<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Grpo;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardDailyController extends Controller
{
    public function index()
    {
        $po_sent_vs_budget = ($this->po_sent_amount()->sum('item_amount') / $this->plant_budget()->sum('amount')) * 100;
        $po_sent_vs_grpo = ($this->grpo_amount()->sum('item_amount') / $this->po_sent_amount()->sum('item_amount')) * 100;
        $npi = $this->incoming_qty()->sum('qty') / $this->outgoing_qty()->sum('qty');
        $projects = ['011C', '017C', '021C', '022C', '023C', 'APS'];

        // $incoming_qty = $this->incoming_qty()->where('project_code', '022C')->sum('qty');
        // return $incoming_qty;
        // die;

        return view('dashboard.daily.index', [
            'projects' => $projects,
            'po_sent_vs_budget' => $po_sent_vs_budget,
            'po_sent_vs_grpo' => $po_sent_vs_grpo,
            'npi' => $npi,
            'plant_budget' => $this->plant_budget()->get(),
            'po_sent' => $this->po_sent_amount()->get(),
            'grpo' => $this->grpo_amount()->get(),
            'incoming_qty' => $this->incoming_qty()->get(),
            'outgoing_qty' => $this->outgoing_qty()->get(),
        ]);
    }

    public function po_sent_amount()
    {
        $date = Carbon::now()->subDay();
        $incl_deptcode = ['40', '50', '60', '140'];

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

    public function plant_budget()
    {
        $date = Carbon::now()->subDay();
        return Budget::where('budget_type_id', 2)
            ->whereYear('date', $date)
            ->whereMonth('date', $date);
    }

    public function grpo_amount()
    {
        $date = Carbon::now()->subDay();
        $incl_deptcode = ['40', '50', '60', '140'];
        $excl_itemcode = ['EX%', 'FU%', 'PB%', 'Pp%', 'SA%', 'SO%', 'SV%']; // , 
        foreach ($excl_itemcode as $e) {
            $excl_itemcode_arr[] = ['item_code', 'not like', $e];
        };

        $list = Grpo::whereMonth('po_delivery_date', $date)
            ->whereMonth('grpo_date', $date)
            ->where('po_delivery_status', 'Delivered')
            ->whereIn('dept_code', $incl_deptcode)
            ->where($excl_itemcode_arr);

        return $list;
    }

    public function incoming_qty()
    {
        $date = Carbon::now()->subDays(3);

        $incl_deptcode = ['40', '50', '60', '140'];

        $excl_itemcode = ['CO%', 'EX%', 'FU%', 'PB%', 'Pp%', 'SA%', 'SO%', 'SV%']; // , 
        foreach ($excl_itemcode as $e) {
            $excl_itemcode_arr[] = ['item_code', 'not like', $e];
        };

        return DB::table('incomings')->whereMonth('posting_date', $date)
                ->whereIn('dept_code', $incl_deptcode)
                ->where($excl_itemcode_arr);
    }

    public function outgoing_qty()
    {
        $date = Carbon::now()->subDay();
        $incl_deptcode = ['40', '50', '60', '140'];

        $excl_itemcode = ['CO%', 'EX%', 'FU%', 'PB%', 'Pp%', 'SA%', 'SO%', 'SV%']; // , 
        foreach ($excl_itemcode as $e) {
            $excl_itemcode_arr[] = ['item_code', 'not like', $e];
        };

        return DB::table('migis')->whereMonth('posting_date', $date)
                    ->whereIn('dept_code', $incl_deptcode)
                    ->where($excl_itemcode_arr);

    }
}
