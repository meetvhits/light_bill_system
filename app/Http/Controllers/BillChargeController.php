<?php

namespace App\Http\Controllers;

use App\Models\BillCharge;
use Illuminate\Http\Request;

class BillChargeController extends Controller
{
    // public function index()
    // {
    //     $billCharges = BillCharge::all();
    //     return view('portal.billcharge.index', compact('billCharges'));
    // }

    // public function create()
    // {
    //     return view('portal.billcharge.create');
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'govt_duty_percentage' => 'required|numeric|min:0|max:100',
    //         'fixed_charge' => 'required|numeric|min:0',
    //     ]);

    //     BillCharge::create($request->all());

    //     return redirect()->route('billcharge')->with('success', 'Bill Charge created successfully.');
    // }

    public function edit()
    {
        $billCharge = BillCharge::findOrFail(1);
        return view('portal.billcharge.edit', compact('billCharge'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'govt_duty_percentage' => 'required|numeric|min:0|max:100',
            'fixed_charge' => 'required|numeric|min:0',
        ]);

        $billCharge = BillCharge::findOrFail($id);
        $billCharge->update($request->all());

        return redirect()->route('editbillcharge')->with('success', 'Bill Charge updated successfully.');
    }

    // public function destroy($id)
    // {
    //     $billCharge = BillCharge::findOrFail($id);
    //     $billCharge->delete();

    //     return redirect()->route('billcharge')->with('success', 'Bill Charge deleted successfully.');
    // }
}
