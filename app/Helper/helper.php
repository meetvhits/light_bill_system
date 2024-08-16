<?php

use App\Models\BillCharge;
use App\Models\Customer;

function getCustomerCount() {
    $customerList = Customer::where('deleted_at', '=', NULL)->get();
    $customerCount = $customerList->count();

    return $customerCount;
}

function getCustomerList() {
    $customerList = Customer::where('deleted_at', '=', NULL)->get();

    return $customerList;
}

function getBillChargeList() {
    $billCharges = BillCharge::first();

    return $billCharges;
}
?>
