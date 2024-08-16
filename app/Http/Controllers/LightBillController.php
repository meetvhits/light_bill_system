<?php

namespace App\Http\Controllers;

use App\Http\Requests\LightBillRequest;
use App\Interfaces\LightBillRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\BillCharge;
use App\Models\Customer;
use App\Models\LightBill;
use App\Models\UnitRange;

class LightBillController extends Controller
{
    protected $lightBillRepository = "";

    public function __construct(LightBillRepositoryInterface $lightBillRepository)
    {
        $this->lightBillRepository = $lightBillRepository;
    }

    public function index()
    {
        $lightBills = $this->lightBillRepository->getlightBillData();

        return view('portal.lightbill.index', compact('lightBills'));
    }

    public function create()
    {
        $customers = getCustomerList();
        return view('portal.lightbill.create', compact('customers'));
    }

    public function store(LightBillRequest $request)
    {
        try {
            $lightBillData = [
                "customer_id" => $request->customer_id,
                "supply_type" => $request->supply_type,
                "reading_date" => $request->reading_date,
                "present_reading" => $request->present_reading,
                "past_reading" => $request->past_reading,
                "past_amount" => $request->past_amount,
            ];
            $lightBills = $this->lightBillRepository->storelightBillData($lightBillData);

            return redirect()->route('lightbill.index')->with('success', 'Light Bill created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('status', 'Something went wrong. Try again please..!!');
        }
    }

    public function show($id)
    {
        $lightBill = LightBill::with('customer')->findOrFail($id);

        return view('portal.lightbill.show', compact('lightBill'));
    }

    public function edit($id)
    {
        $lightBill = LightBill::findOrFail($id);
        $customers = getCustomerList();
        return view('portal.lightbill.edit', compact('lightBill', 'customers'));
    }

    public function update(LightBillRequest $request, $id)
    {
        try {
            $lightBillData = [
                "customer_id" => $request->customer_id,
                "supply_type" => $request->supply_type,
                "reading_date" => $request->reading_date,
                "present_reading" => $request->present_reading,
                "past_reading" => $request->past_reading,
                "past_amount" => $request->past_amount,
            ];

            $lightBills = $this->lightBillRepository->updatelightBillData($lightBillData, $id);

            return redirect()->route('lightbill.index')->with('success', 'Light Bill updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('status', 'Something went wrong. Try again please..!!');
        }

    }

    public function destroy($id)
    {
        try {
            $this->lightBillRepository->deleteLightBill($id);

            return redirect('lightbill')->with('status', 'Light Bill Delete Successfully...');
        } catch (\Exception $e) {
            return redirect()->back()->with('status', 'Something went wrong. Try again please..!!');
        }
    }
}
