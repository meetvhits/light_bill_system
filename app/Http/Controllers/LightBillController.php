<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BillCharge;
use App\Models\Customer;
use App\Models\LightBill;
use App\Models\UnitRange;

class LightBillController extends Controller
{
    public function index()
    {
        $lightBills = LightBill::with('customer')->get();
        return view('portal.lightbill.index', compact('lightBills'));
    }

    public function create()
    {
        $customers = Customer::all();
        return view('portal.lightbill.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required',
            'supply_type' => 'required',
            'reading_date' => 'required|date',
            'present_reading' => 'required|integer',
            'past_reading' => 'required|integer',
            'past_amount' => 'required|numeric',
        ]);

        $units_consumed = $request->present_reading - $request->past_reading;
        $unit_rate = UnitRange::where('start_range', '<=', $units_consumed)
            ->where('end_range', '>=', $units_consumed)
            ->first()->price ?? 0;

        $charges = BillCharge::first();

        // dd($unit_rate);
        $govt_duty_charge = $charges->govt_duty_percentage / 100 * $units_consumed * $unit_rate;
        $totalAmount = ($units_consumed * $unit_rate) + $charges->fixed_charge + $govt_duty_charge;

        if ($request->past_amount) {
            $totalAmount = $totalAmount + $request->past_amount;
        }
        // dd($totalAmount);


        // $totalAmount = ($units * $unitPrice) + $lightBillCharge->fixed_charge + (($lightBillCharge->govt_duty_percentage / 100) * $units * $unitPrice);

        LightBill::create($request->all() + [
            'base_rate' => $unit_rate,
            'total_units' => $units_consumed,
            'fixed_charge' => $charges->fixed_charge,
            'govt_duty' => $charges->govt_duty_percentage,
            'govt_duty_charge' => $govt_duty_charge,
            'total_amount' => $totalAmount,
        ]);

        return redirect()->route('lightbill')->with('success', 'Light Bill created successfully.');
    }

    public function show($id)
    {
        $lightBill = LightBill::with('customer')->findOrFail($id);

        // $pdf = PDF::loadView('pdf', compact('show'));
        return view('portal.lightbill.show', compact('lightBill'));
    }

    public function edit($id)
    {
        $lightBill = LightBill::findOrFail($id);
        $customers = Customer::all();
        return view('portal.lightbill.edit', compact('lightBill', 'customers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_id' => 'required',
            'supply_type' => 'required',
            'reading_date' => 'required|date',
            'present_reading' => 'required|integer',
            'past_reading' => 'required|integer',
            'past_amount' => 'required|numeric',
        ]);

        $lightBill = LightBill::findOrFail($id);

        // $units = $request->present_reading - $request->past_reading;
        // $unitPrice = UnitRange::where('start_range', '<=', $units)->where('end_range', '>=', $units)->first()->price;
        // $lightBillCharge = BillCharge::first();

        // $energyCharges = $units * $unitPrice;
        // $govtDuty = ($lightBillCharge->govt_duty_percentage / 100) * $energyCharges;
        // $totalAmount = $energyCharges + $lightBillCharge->fixed_charge + $govtDuty;

        // // Round the total amount if necessary
        // $totalAmount = round($totalAmount, 2); // Round to two decimal places

        // $totalAmount = ($units * $unitPrice) + $lightBillCharge->fixed_charge + (($lightBillCharge->govt_duty_percentage / 100) * $units * $unitPrice);

        $units_consumed = $request->present_reading - $request->past_reading;
        $unit_rate = UnitRange::where('start_range', '<=', $units_consumed)
            ->where('end_range', '>=', $units_consumed)
            ->first()->price ?? 0;

        $charges = BillCharge::first();

        // dd($unit_rate);
        // dd($charges->govt_duty_percentage / 100 * $units_consumed * $unit_rate);
        $totalAmount = ($units_consumed * $unit_rate) + $charges->fixed_charge + ($charges->govt_duty_percentage / 100 * $units_consumed * $unit_rate);

        if ($request->past_amount) {
            $totalAmount = $totalAmount + $request->past_amount;
        }
        dd($totalAmount);

        $lightBill->update($request->all() + ['total_amount' => $totalAmount]);

        return redirect()->route('lightbill')->with('success', 'Light Bill updated successfully.');
    }

    public function destroy($id)
    {
        $lightBill = LightBill::findOrFail($id);
        $lightBill->delete();

        return redirect()->route('lightbill')->with('success', 'Light Bill deleted successfully.');
    }
}
