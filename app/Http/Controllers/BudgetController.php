<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\BudgetType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BudgetController extends Controller
{
    public function index()
    {
        $projects = Http::get('http://localhost:5000/projects')->json()['data'];
        $budget_types = BudgetType::orderBy('display_name')->get();

        return view('budget.index', compact('projects', 'budget_types'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $test = $request->validate([
            'date' => 'required',
            'budget_type_id' => 'required',
            'project_code' => 'required',
            'amount' => 'required',
            'remarks' => 'string',
        ]);

        // return $test;
        // die;

        Budget::create([
            'date' => $request->date . '-01',
            'budget_type_id' => $request->budget_type_id,
            'project_code' => $request->project_code,                             
            'amount' => $request->amount,
            'remarks' => $request->remarks,
        ]);

        return redirect()->route('budget.index')->with('success', 'Budget has been added');
    }

    public function edit($id)
    {
        $budget = Budget::find($id);
        $projects = Http::get('http://localhost:5000/projects')->json()['data'];
        $budget_types = BudgetType::orderBy('display_name')->get();

        return view('budget.edit', compact('budget', 'projects', 'budget_types'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'date'              => 'required',
            'budget_type_id'    => 'required',
            'project_code'      => 'required',
            'amount'            => 'required',
            'remarks'           => 'string',
        ]);

        $budget = Budget::find($id);
        $budget->date = $request->date . '-01';
        $budget->budget_type_id = $request->budget_type_id;
        $budget->project_code = $request->project_code;
        $budget->amount = $request->amount;
        $budget->remarks = $request->remarks;
        $budget->save();

        return redirect()->route('budget.index')->with('success', 'Budget has been updated');
    }

    public function destroy($id)
    {
        $budget = Budget::findOrFail($id);
        $budget->delete();

        return redirect()->route('budget.index')->with('success', 'Budget has been deleted');
    }

    public function data()
    {
        $list = Budget::orderBy('date', 'desc')
                ->get();

        return datatables()->of($list)
                ->editColumn('date', function($list) {
                    return date('F Y', strtotime($list->date));
                })
                ->editColumn('amount', function($list) {
                    return number_format($list->amount, 0);
                })
                ->editColumn('budget_type', function($list) {
                    return $list->budget_type->display_name;
                })
                ->addIndexColumn()
                ->addColumn('action', 'budget.action')
                ->rawColumns(['action'])
                ->toJson();
    }
}
