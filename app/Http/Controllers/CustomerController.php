<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use App\Repositories\CustomerRepository;

class CustomerController extends Controller
{
    protected $customerRepository = "";

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function index() {

        $customers = $this->customerRepository->getCustomerData();

        return view('portal.customer.index', compact('customers'));
    }

    public function create() {
        return view('portal.customer.create');
    }

    public function store(CustomerRequest $request) {
        $customerDetails = $request->all();
        try {
            $this->customerRepository->storeCustomerData($customerDetails);

            return redirect('customer')->with('status', 'Customer Added Successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('status', 'Something went wrong. Try again please..!!');
        }
    }

    public function edit($id) {
        $customer = Customer::find($id);

        return view('portal.customer.edit', compact('customer'));
    }

    public function update(CustomerRequest $request, Customer $customer) {
      
        $customerDetails = $request->all();
        try {
            $this->customerRepository->updateCustomerData($customerDetails, $customer->id);

            return redirect('customer')->with('status', 'Customer Updated Successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('status', 'Something went wrong. Try again please..!!');
        }
    }

    public function destroy($id) {

        try {
            $this->customerRepository->deleteCustomer($id);

            return redirect('customer')->with('status', 'Customer Delete Successfully...');
        } catch (\Exception $e) {
            return redirect()->back()->with('status', 'Something went wrong. Try again please..!!');
        }
    }
}
