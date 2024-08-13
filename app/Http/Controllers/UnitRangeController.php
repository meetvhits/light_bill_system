<?php

namespace App\Http\Controllers;

use App\Models\UnitRange;
use Illuminate\Http\Request;

class UnitRangeController extends Controller
{
    public function index()
    {
        $unitRanges = UnitRange::all();
        return view('portal.unitrange.index', compact('unitRanges'));
    }

    public function create()
    {
        return view('portal.unitrange.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'unit_ranges.*.start_range' => 'required|integer',
            'unit_ranges.*.end_range' => 'required|integer',
            'unit_ranges.*.price' => 'required|numeric',
        ]);

        foreach ($request->unit_ranges as $range) {
            UnitRange::create($range);
        }

        return redirect()->route('unitrange')->with('success', 'Unit Ranges created successfully.');
    }

    public function edit($id)
    {
        $unitRange = UnitRange::findOrFail($id);
        return view('portal.unitrange.edit', compact('unitRange'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'start_range' => 'required|integer',
            'end_range' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $unitRange = UnitRange::findOrFail($id);
        $unitRange->update($request->all());

        return redirect()->route('unitrange')->with('success', 'Unit Range updated successfully.');
    }

    public function destroy($id)
    {
        $unitRange = UnitRange::findOrFail($id);
        $unitRange->delete();

        return redirect()->route('unitrange')->with('success', 'Unit Range deleted successfully.');
    }
}
