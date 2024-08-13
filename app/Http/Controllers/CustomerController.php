<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index() {

        $customers = Customer::all();
        return view('portal.customer.index', compact('customers'));
    }

    public function create() {
        return view('portal.customer.create');
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

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'gender' => 'required|alpha',
            'email' => 'required|email:rfc,dns|unique:customers,email',
            'phone' => 'required|numeric|digits:10|regex:/^([0-9\s\-\+\(\)]*)$/|unique:customers,phone',
            'address' => 'required',
        ],
        [
            'first_name.required' => 'First Name required.',
            'first_name.alpha' => 'First Name accepts only Letter.',
            'last_name.required' => 'Last Name required.',
            'last_name.alpha' => 'Last Name accepts only Letter.',
            'email.required' => 'Email required.',
            'email.unique' => 'Email has already been taken.',
            'phone.required' => 'Mobile Number required.',
            'phone.numeric' => 'Mobile Number only in numeric value & accepts only 10 Digits..',
            'phone.digits' => 'Mobile Number should be 10 Digits.',
            'phone.unique' => 'Mobile Number has already in use.',
            'gender.required' => 'Gender required',
            'address.required' => 'Address required',
        ]);

        if ($validator->fails()) {
            return redirect('addcustomer')
                ->withErrors($validator)
                ->withInput();
        }

        $serviceNo = $this->generateUniqueServiceNo();

        $customer = new Customer();
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->gender = $request->gender;
        $customer->address = $request->address;
        $customer->service_no = $serviceNo;
        $customer->save();

        return redirect('customer')->with('status', 'Customer Added Successfully.');
    }

    public function edit($id) {
        $customer = Customer::find($id);

        return view('portal.customer.edit', compact('customer'));
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'gender' => 'required|alpha',
            'email' => [
                'required',
                'email:rfc,dns',
                Rule::unique('customers')->ignore($id)
            ],
            'phone' => [
                'required',
                'numeric',
                'digits:10',
                'regex:/^([0-9\s\-\+\(\)]*)$/',
                Rule::unique('customers')->ignore($id),
            ],
            'address' => 'required',
        ],
        [
            'first_name.required' => 'First Name required.',
            'first_name.alpha' => 'First Name accepts only Letter.',
            'last_name.required' => 'Last Name required.',
            'last_name.alpha' => 'Last Name accepts only Letter.',
            'email.required' => 'Email required.',
            'email.unique' => 'Email has already been taken.',
            'phone.required' => 'Mobile Number required.',
            'phone.numeric' => 'Mobile Number only in numeric value & accepts only 10 Digits..',
            'phone.digits' => 'Mobile Number should be 10 Digits.',
            'phone.unique' => 'Mobile Number has already in use.',
            'gender.required' => 'Gender required',
            'address.required' => 'Address required',
        ]);

        if ($validator->fails()) {
            return redirect('editcustomer')
                ->withErrors($validator)
                ->withInput();
        }

        $inputs = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address
        ];
        $customer = Customer::find($id);
        $customer->update($inputs);
        $customer->save();

        return redirect('customer')->with('status', 'Customer update Successfully.');
    }

    public function destroy($id) {

        $customer = Customer::find($id);
        if ($customer) {
            $customer->delete();
        }
        return redirect('customer')->with('status', 'Customer Delete Successfully...');
    }
}
