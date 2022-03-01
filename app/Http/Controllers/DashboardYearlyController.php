<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Grpo;
use App\Models\History;
use App\Models\Incoming;
use App\Models\Migi;
use App\Models\Powitheta;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardYearlyController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $years = DB::table('histories')->select('periode', 'date')
                ->where('periode', 'yearly')
                ->whereYear('date', '<', $now)
                ->distinct('date')
                ->get();

        return view('dashboard.yearly.index', compact('years'));
    }

    public function display(Request $request)
    {
        $this->validate($request, [
            'year' => ['required']
        ]);

        $now = Carbon::now();
        $years = DB::table('histories')->select('periode', 'date')
                ->where('periode', 'yearly')
                ->whereYear('date', '<', $now)
                ->distinct('date')
                ->get();

        $projects = ['011C', '017C', '021C', '022C', '023C', 'APS'];

        if ($request->year !== 'this_year') {
            $year_title = $request->year;
            $plant_budget = $this->plant_budget($request->year);
            $histories = $this->yearly_history_amount($request->year);

            return view('dashboard.yearly.display', [
                'year_title' => $year_title,
                'years' => $years,
                'projects' => $projects,
                'plant_budget' => $plant_budget,
                'histories' => $histories,
            ]);

        } else {
            
            // $po_sent = $this->po_sent_this_year()->where('project_code', '011C');
            // $grpo_amount = $this->grpo_amount();
            // $plant_budget = $this->plant_budget(Carbon::now()->year);
            // return $po_sent;
            // return $plant_budget->where('project_code', '011C');
            // die;

            return view('dashboard.yearly.display', [
                'year_title' => 'This Year',
                'years' => $years,
                'projects' => $projects,
                'plant_budget' => $this->plant_budget(Carbon::now()->year),
                'po_sent' => $this->po_sent_this_year(),
                'grpo_amount' => $this->grpo_amount(),
                'incoming_qty' => $this->incoming_qty(),
                'outgoing_qty' => $this->outgoing_qty()
            ]);
        }
    }

    public function plant_budget($date)
    {
        $year = substr($date, 0, 4);

        return Budget::where('budget_type_id', 2)
            ->whereYear('date', $year)
            ->get();
    }

    public function yearly_history_amount($date)
    {
        $year = substr($date, 0, 4);

        $list = History::where('periode', 'yearly')
                ->whereYear('date', $year)
                ->get();

        return $list;
    }

    public function po_sent_this_year()
    {
        $incl_deptcode = ['40', '50', '60', '140'];

        $excl_itemcode = ['EX%', 'FU%', 'PB%', 'Pp%', 'SA%', 'SO%', 'SV%']; // , 
        foreach ($excl_itemcode as $e) {
            $excl_itemcode_arr[] = ['item_code', 'not like', $e];
        };

        $list = Powitheta::whereIn('dept_code', $incl_deptcode) //
                ->where($excl_itemcode_arr)
                ->where('po_delivery_status', 'Delivered')
                ->where('po_status', '!=', 'Cancelled')
                ->get();

        return $list;
    }

    public function grpo_amount()
    {
        $incl_deptcode = ['40', '50', '60', '140'];
        $excl_itemcode = ['EX%', 'FU%', 'PB%', 'Pp%', 'SA%', 'SO%', 'SV%']; // , 
        foreach ($excl_itemcode as $e) {
            $excl_itemcode_arr[] = ['item_code', 'not like', $e];
        };

        $list = Grpo::where('po_delivery_status', 'Delivered')
            ->whereIn('dept_code', $incl_deptcode)
            ->where($excl_itemcode_arr)
            ->get();

        return $list;
    }

    public function incoming_qty()
    {
        $incl_deptcode = ['40', '50', '60', '140'];

        $excl_itemcode = ['CO%', 'EX%', 'FU%', 'PB%', 'Pp%', 'SA%', 'SO%', 'SV%']; // , 
        foreach ($excl_itemcode as $e) {
            $excl_itemcode_arr[] = ['item_code', 'not like', $e];
        };

        return Incoming::whereIn('dept_code', $incl_deptcode)
            ->where($excl_itemcode_arr)
            ->get();
    }

    public function outgoing_qty() 
    {
        $incl_deptcode = ['40', '50', '60', '140'];

        $excl_itemcode = ['CO%', 'EX%', 'FU%', 'PB%', 'Pp%', 'SA%', 'SO%', 'SV%']; // , 
        foreach ($excl_itemcode as $e) {
            $excl_itemcode_arr[] = ['item_code', 'not like', $e];
        };

        return Migi::whereIn('dept_code', $incl_deptcode)
                    ->where($excl_itemcode_arr)
                    ->get();
    }
}
