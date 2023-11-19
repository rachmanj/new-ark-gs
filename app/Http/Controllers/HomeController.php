<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $reguler_daily = app(CapexController::class)->reguler_daily()['reguler'];
        $capex_daily = app(CapexController::class)->capex_daily()['capex'];

        // return $capex_daily;
        return view('home', compact([
            'reguler_daily',
            'capex_daily',
        ]));
    }
}
