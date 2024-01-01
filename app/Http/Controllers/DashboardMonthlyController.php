<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\History;
use Illuminate\Http\Request;

class DashboardMonthlyController extends Controller
{
    public function index()
    {
        return view('dashboard.monthly.index');
    }

    public function display(Request $request)
    {
        $projects = ['011C', '017C', '021C', '022C', '023C', 'APS'];
        $data = app(MonthlyHistoryController::class)->index($request->month);

        return view('dashboard.monthly.new_display', [
            'month' => $request->month,
            // 'projects' => $projects,
            // 'plant_budget' => $this->plant_budget($request->month),
            // 'histories' => $this->monthly_history_amount($request->month),
            'data' => $data,
        ]);
    }

    public function plant_budget($date)
    {
        $year = substr($date, 0, 4);
        $month = substr($date, 5, 2);

        return Budget::where('budget_type_id', 2)
            ->whereYear('date', $year)
            ->whereMonth('date',$month)
            ->get();
    }

    public function monthly_history_amount($date)
    {
        $month = substr($date, 5, 2);
        $year = substr($date, 0, 4);

        $list = History::where('periode', 'monthly')
                ->whereYear('date', $year)
                ->whereMonth('date', $month)
                ->get();

        return $list;
    }
    
}
