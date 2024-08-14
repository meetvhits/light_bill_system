<?php

namespace App\Http\Controllers;

use App\Http\Requests\BillChargeRequest;
use App\Models\BillCharge;
use App\Repositories\BillChargeRepository;

class BillChargeController extends Controller
{
    protected $billChargeRepository = "";

    public function __construct(BillChargeRepository $billChargeRepository)
    {
        $this->billChargeRepository = $billChargeRepository;
    }

    public function edit()
    {
        $billCharge = BillCharge::findOrFail(1);
        return view('portal.billcharge.edit', compact('billCharge'));
    }

    public function update(BillChargeRequest $request)
    {
        $billChargeDetails = $request->all();
        try {
            $this->billChargeRepository->updateBillCharge($billChargeDetails, 1);

            return redirect()->route('billcharge.edit', [1])->with('success', 'Bill Charge Updated Successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', 'Something went wrong. Try again please..!!');
        }

    }
}
