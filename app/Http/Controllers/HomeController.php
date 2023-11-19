<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $reguler_daily = app(CapexController::class)->reguler_daily()['reguler'];
        $capex_daily = app(CapexController::class)->capex_daily()['capex'];
        $npi_daily = app(NpiController::class)->index()['npi'];
        $grpo_daily = app(GrpoIndexController::class)->index()['grpo_daily'];

        // return $capex_daily;
        return view('home', compact([
            'reguler_daily',
            'capex_daily',
            'npi_daily',
            'grpo_daily',
        ]));
    }
}
