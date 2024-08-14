<?php

namespace App\Repositories;


use App\Interfaces\LightBillRepositoryInterface;
use App\Models\LightBill;


class LightBillRepository implements LightBillRepositoryInterface
{
    public function getlightBillData()
    {
        return LightBill::with('customer')->get();
    }

    public function storeCustomerData($customerDetails)
    {
        $insertData = array(
            'first_name' => $customerDetails['first_name'],
            'last_name' => $customerDetails['last_name'],
            'email' => $customerDetails['email'],
            'phone' => $customerDetails['phone'],
            'gender' => $customerDetails['gender'],
            'address' => $customerDetails['address'],
            'service_no' => $serviceNo,
        );

        $customer = Customer::create($insertData);
        return $customer;
    }

    public function updateCustomerData($customerDetails, $id)
    {
        $updateData = array(
            'first_name' => $customerDetails['first_name'],
            'last_name' => $customerDetails['last_name'],
            'email' => $customerDetails['email'],
            'phone' => $customerDetails['phone'],
            'gender' => $customerDetails['gender'],
            'address' => $customerDetails['address'],
        );

        $updateCustomer = Customer::find($id);
        $updateCustomer->update($updateData);

        return $updateCustomer;
    }
    public function deleteCustomer($id)
    {
        return Customer::where('id', $id)->delete();
    }
}
