<?php

namespace App\Repositories;


use App\Interfaces\LightBillRepositoryInterface;
use App\Models\LightBill;
use App\Models\UnitRange;

class LightBillRepository implements LightBillRepositoryInterface
{
    public function getlightBillData()
    {
        return LightBill::with('customer')->get();
    }

    public function storelightBillData($lightBillData)
    {
        $units_consumed = $lightBillData['present_reading'] - $lightBillData['past_reading'];
        $unit_rate = UnitRange::where('start_range', '<=', $units_consumed)
            ->where('end_range', '>=', $units_consumed)
            ->first()->price ?? 0;

        $charges = getBillChargeList();

        $govt_duty_charge = $charges->govt_duty_percentage / 100 * $units_consumed * $unit_rate;
        $totalAmount = ($units_consumed * $unit_rate) + $charges->fixed_charge + $govt_duty_charge;

        if ($lightBillData['past_amount']) {
            $totalAmount = $totalAmount + $lightBillData['past_amount'];
        }

        $lightBill = LightBill::create($lightBillData + [
            'base_rate' => $unit_rate,
            'total_units' => $units_consumed,
            'fixed_charge' => $charges->fixed_charge,
            'govt_duty' => $charges->govt_duty_percentage,
            'govt_duty_charge' => $govt_duty_charge,
            'total_amount' => $totalAmount,
        ]);

        return $lightBill;
    }

    public function updatelightBillData($lightBillData, $id)
    {
        $lightBill = LightBill::findOrFail($id);

        $units_consumed = $lightBillData['present_reading'] - $lightBillData['past_reading'];
        $unit_rate = UnitRange::where('start_range', '<=', $units_consumed)
            ->where('end_range', '>=', $units_consumed)
            ->first()->price ?? 0;

        $charges = getBillChargeList();

        $totalAmount = ($units_consumed * $unit_rate) + $charges->fixed_charge + ($charges->govt_duty_percentage / 100 * $units_consumed * $unit_rate);

        if ($lightBillData['past_amount']) {
            $totalAmount = $totalAmount + $lightBillData['past_amount'];
        }

        $updateLightBill = $lightBill->update($lightBillData + ['total_amount' => $totalAmount]);

        return $updateLightBill;
    }
    public function deleteLightBill($id)
    {
        return LightBill::where('id', $id)->delete();
    }
}
