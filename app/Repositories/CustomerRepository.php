<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;

use App\Interfaces\CustomerRepositoryInterface;
use App\Models\Customer;


class CustomerRepository implements CustomerRepositoryInterface
{
    public function login($request)
    {
        $response = ['status' => false, 'data' => []];
        $field = $request->input('email_or_phone');
        $identifier = filter_var($field, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone_number';
        $request->merge([$identifier => $field]);
        if (Auth::attempt($request->only($identifier, 'password'))) {
            return redirect('dashboard')->with('success', 'You Have Successfully Logged in.');
        } else {
            return redirect()->back()->with('fail', 'You have entered an invalid email/phone or password.');
        }
        return $response;
    }

    public function getCustomerData()
    {
        return Customer::where('deleted_at', '=', NULL)->get();
    }

    private function generateRandomServiceNo($length = 15) {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    private function generateUniqueServiceNo($length = 15) {
        do {
            $serviceNo = $this->generateRandomServiceNo($length);
            $exists = Customer::where('service_no', $serviceNo)->exists();
        } while ($exists);

        return $serviceNo;
    }

    public function storeCustomerData($customerDetails)
    {
        $serviceNo = $this->generateUniqueServiceNo();
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
