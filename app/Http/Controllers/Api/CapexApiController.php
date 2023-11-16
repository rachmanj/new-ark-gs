<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CapexApiController extends Controller
{
    public function index()
    {
        $reguler_daily = app('App\Http\Controllers\CapexController')->reguler_daily();
        $data = $reguler_daily['reguler'];

        return $data;
    }
}
