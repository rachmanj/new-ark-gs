<?php

namespace App\Http\Controllers;

use App\Models\BudgetType;
use Illuminate\Http\Request;

class BudgetTypeController extends Controller
{
    public function index()
    {
        return view('budget_type.index');
    }

    public function store(Request $request)
    {
        $validated_data = $this->validate($request, [
            'name' => 'required|string|max:255',
            'display_name' => 'required|string|max:255',
        ]);

        BudgetType::create($validated_data);

        return redirect()->route('budget_type.index')->with('success', 'Budget Type created successfully.');
    }

    public function edit($id)
    {
        $budget_type = BudgetType::findOrFail($id);
        return view('budget_type.edit', compact('budget_type'));
    }

    public function update(Request $request, $id)
    {
        $budget_type = BudgetType::findOrFail($id);

        $validated_data = $this->validate($request, [
            'name' => 'required|string|max:255',
            'display_name' => 'required|string|max:255',
        ]);

        $budget_type->update($validated_data);

        return redirect()->route('budget_type.index')->with('success', 'Budget Type updated successfully.');
    }

    public function destroy($id)
    {
        $budget_type = BudgetType::findOrFail($id);
        $budget_type->delete();

        return redirect()->route('budget_type.index')->with('success', 'Budget Type deleted successfully.');
    }

    public function data()
    {
        $list = BudgetType::latest()->get();

        return datatables()->of($list)
                ->addColumn('action', 'budget_type.action')
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->toJson();
    }
}
