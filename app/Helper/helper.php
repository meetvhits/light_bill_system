<?php

use App\Models\Customer;

function getCustomerCount() {
    $customerList = Customer::where('deleted_at', '=', NULL)->get();
    $customerCount = $customerList->count();

    return $customerCount;
}

?>
