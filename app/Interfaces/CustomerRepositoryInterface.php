<?php

namespace App\Interfaces;

interface CustomerRepositoryInterface
{
    public function getCustomerData();
    public function storeCustomerData($customerDetails);
    public function updateCustomerData($customerDetails, $id);
    public function deleteCustomer($id);
}
