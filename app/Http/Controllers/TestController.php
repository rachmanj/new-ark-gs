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
        $test = app(NpiController::class)->index();
        return $test;
    }
}
