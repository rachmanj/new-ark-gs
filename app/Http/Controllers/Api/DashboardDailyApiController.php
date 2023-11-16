<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardDailyApiController extends Controller
{
    public function reguler_daily()
    {
        $reguler_daily = app('App\Http\Controllers\CapexController')->reguler_daily();
        $data = $reguler_daily['reguler'];

        return $data;
    }

    public function capex_daily()
    {
        $capex_daily = app('App\Http\Controllers\CapexController')->capex_daily();
        $data = $capex_daily['capex'];

        return $data;
    }
}
