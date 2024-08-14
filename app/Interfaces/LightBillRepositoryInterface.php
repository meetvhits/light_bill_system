<?php

namespace App\Interfaces;

interface LightBillRepositoryInterface
{
    public function storelightBillData($lightBillDetails);
    public function changeUserStatus($userd, $status);
    public function updatelightBillData($lightBillDetails, $id);
    public function deletelightBill($id);
}
