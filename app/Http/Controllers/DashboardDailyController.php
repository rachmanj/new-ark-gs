<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Grpo;
use App\Models\History;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardDailyController extends Controller
{
    public function index()
    {
        $capex_daily = app(CapexController::class)->capex_daily();
        $reguler_daily = app(CapexController::class)->reguler_daily();
        $grpo_daily = app(GrpoIndexController::class)->index();
        $npi_daily = app(NpiController::class)->index();
         
        return view('dashboard.daily.index', [
            'report_date' => Carbon::now()->subDay()->format('d-M-Y'),
            'capex_daily' => $capex_daily,
            'reguler_daily' => $reguler_daily,
            'grpo_daily' => $grpo_daily,
            'npi_daily' => $npi_daily
        ]);
    }
}
