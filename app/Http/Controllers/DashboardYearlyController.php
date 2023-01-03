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
            // $plant_budget = $this->plant_budget();
            $histories = $this->yearly_history_amount($request->year);

            return view('dashboard.yearly.display', [
                'year_title' => $year_title,
                'years' => $years,
                'projects' => $projects,
                'plant_budget' => $plant_budget,
                'histories' => $histories,
            ]);
        } else {
            return view('dashboard.yearly.display', [
                'year_title' => 'This Year',
                'years' => $years,
                'projects' => $projects,
                'plant_budget' => $this->plant_budget(Carbon::now()->year),
                'po_sent' => $this->po_sent(),
                'grpo_amount' => $this->grpo_amount(),
                'incoming_qty' => $this->incoming_qty(),
                'outgoing_qty' => $this->outgoing_qty()
            ]);
        }
    }

    public function yearly_history_amount($date)
    {
        $year = substr($date, 0, 4);

        $list = History::where('periode', 'yearly')
                ->whereYear('date', $year)
                ->get();

        return $list;
    }

    public function grpo_amount()
    {
        $date = Carbon::now();

        $incl_deptcode = ['40', '50', '60', '140'];
        $excl_itemcode = ['EX%', 'FU%', 'PB%', 'Pp%', 'SA%', 'SO%', 'SV%']; // , 
        foreach ($excl_itemcode as $e) {
            $excl_itemcode_arr[] = ['item_code', 'not like', $e];
        };

        $include_project = ['011C', '017C', '021C', '022C', '023C', 'APS'];

        $list = Grpo::select('project_code', DB::raw('SUM(item_amount) as amount'))
            ->where('po_delivery_status', 'Delivered')
            ->whereYear('grpo_date', $date)
            ->whereIn('project_code', $include_project)
            ->whereIn('dept_code', $incl_deptcode)
            ->where($excl_itemcode_arr)
            ->groupBy('project_code')
            ->get();

        return $list;
    }

    public function incoming_qty()
    {
        $date = Carbon::now();

        $incl_deptcode = ['40', '50', '60', '140'];
        $include_project = ['011C', '017C', '021C', '022C', '023C', 'APS'];

        $excl_itemcode = ['CO%', 'EX%', 'FU%', 'PB%', 'Pp%', 'SA%', 'SO%', 'SV%']; // , 
        foreach ($excl_itemcode as $e) {
            $excl_itemcode_arr[] = ['item_code', 'not like', $e];
        };

        return Incoming::select('project_code', DB::raw('SUM(qty) as quantity'))
            ->whereYear('posting_date', $date)
            ->whereIn('project_code', $include_project)
            ->whereIn('dept_code', $incl_deptcode)
            ->where($excl_itemcode_arr)
            ->groupBy('project_code')
            ->get();
    }

    public function outgoing_qty() 
    {
        $date = Carbon::now();

        $incl_deptcode = ['40', '50', '60', '140'];
        $include_project = ['011C', '017C', '021C', '022C', '023C', 'APS'];

        $excl_itemcode = ['CO%', 'EX%', 'FU%', 'PB%', 'Pp%', 'SA%', 'SO%', 'SV%']; // , 
        foreach ($excl_itemcode as $e) {
            $excl_itemcode_arr[] = ['item_code', 'not like', $e];
        };

        return Migi::select('project_code', DB::raw('SUM(qty) as quantity'))
            ->whereYear('posting_date', $date)
            ->whereIn('project_code', $include_project)
            ->whereIn('dept_code', $incl_deptcode)
            ->where($excl_itemcode_arr)
            ->groupBy('project_code')
            ->get();
    }

    public function po_sent()
    {
        $date = Carbon::now();
        $incl_deptcode = ['40', '50', '60', '140'];

        $excl_itemcode = ['EX%', 'FU%', 'PB%', 'Pp%', 'SA%', 'SO%', 'SV%']; // , 
        foreach ($excl_itemcode as $e) {
            $excl_itemcode_arr[] = ['item_code', 'not like', $e];
        };

        $include_project = ['011C', '017C', '021C', '022C', '023C', 'APS'];

        $list = Powitheta::select('project_code', DB::raw('SUM(item_amount) as amount') )
                ->whereYear('po_delivery_date', $date)
                ->whereIn('dept_code', $incl_deptcode) //
                ->where($excl_itemcode_arr)
                ->where('po_delivery_status', 'Delivered')
                ->where('po_status', '<>', 'Cancelled')
                ->whereIn('project_code', $include_project)
                ->groupBy('project_code')
                ->get();

        return $list;
    }

    public function plant_budget($date)
    {
         $year = substr($date, 0, 4);
        //  $date = Carbon::now()->subYear();

         return Budget::select('project_code', DB::raw('SUM(amount) as budget_amount'))
             ->where('budget_type_id', 2)
             ->whereYear('date', $year)
             ->groupBy('project_code')
             ->get();
    }

    public function test()
    {
        // $year = substr($date, 0, 4);
        $year = '2021';

        $list = History::where('periode', 'yearly')
                ->whereYear('date', $year)
                ->get();

        return $list;
    }
}
