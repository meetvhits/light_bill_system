<?php

namespace App\Interfaces;

interface BillChargeRepositoryInterface
{
    public function updateBillCharge($BillChargeDetails, $id);
}
