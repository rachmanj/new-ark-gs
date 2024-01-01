<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public $include_projects = ['011C', '017C', '021C', '022C', '023C', 'APS'];

    public function index()
    {
        // $test = app(GrpoIndexController::class)->index();
        // $test = app(YearlyIndexController::class)->index();
        // $test = app(YearlyIndexController::class)->periode();
        // $test = app(YearlyHistoryController::class)->index('2021-01-01');
        $test = app(MonthlyHistoryController::class)->index('2023-12-31');
        
        return $test;
    }
}
