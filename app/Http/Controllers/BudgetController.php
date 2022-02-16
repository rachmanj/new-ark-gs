<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    public function index()
    {
        return view('budget.index');
    }

    public function create()
    {
        //
    }

    public function data()
    {
        $list = Budget::orderBy('date', 'desc')
                ->get();

        return datatables()->of($list)
                ->addIndexColumn()
                ->addColumn('action', 'budget.action')
                ->rawColumns(['action'])
                ->toJson();
    }
}
