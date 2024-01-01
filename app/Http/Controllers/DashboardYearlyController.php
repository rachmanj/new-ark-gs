<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardYearlyController extends Controller
{
    public function index()
    {
        $years = DB::table('histories')->select('periode', 'date')
                ->where('periode', 'yearly')
                ->whereYear('date', '<', Carbon::now())
                ->distinct('date')
                ->get();

        return view('dashboard.yearly.index', compact('years'));
    }

    public function display(Request $request)
    {
        $this->validate($request, [
            'year' => ['required']
        ]);

        $years = DB::table('histories')->select('periode', 'date')
                ->where('periode', 'yearly')
                ->whereYear('date', '<', Carbon::now())
                ->distinct('date')
                ->get();

        if ($request->year !== 'this_year') {
            $year_title = $request->year;

            $data = app(YearlyHIstoryController::class)->index($request->year);

            return view('dashboard.yearly.new_display', [
                'year_title' => $year_title,
                'years' => $years,
                'data' => $data,
            ]);
        } else {
            $data = app(YearlyIndexController::class)->index();

            return view('dashboard.yearly.new_display', [
                'year_title' => 'This Year',
                'years' => $years,
                'data' => $data,
            ]);
        }
    }
}
