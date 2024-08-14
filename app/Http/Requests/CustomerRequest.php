<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('customer')->id;

        if ($id == "") {
            return [
                'first_name' => 'required|alpha',
                'last_name' => 'required|alpha',
                'gender' => 'required|alpha',
                'email' => ['required', 'string', 'email', Rule::unique('customers')->whereNull('deleted_at')],
                'phone' => ['required', 'numeric', 'digits:10', 'regex:/^([0-9\s\-\+\(\)]*)$/', Rule::unique('customers')->whereNull('deleted_at')],
                'address' => 'required',
            ];
        } else {
            return [
                'first_name' => 'required|alpha',
                'last_name' => 'required|alpha',
                'gender' => 'required|alpha',
                'email' => ['required', 'string', 'email', Rule::unique('customers')->ignore($id)->whereNull('deleted_at')],
                'phone' => ['required', 'numeric', 'digits:10', 'regex:/^([0-9\s\-\+\(\)]*)$/', Rule::unique('customers')->ignore($id)->whereNull('deleted_at')],
                'address' => 'required',
            ];
        }
    }

    public function messages()
    {
        $messages = array(
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
        );

        return $messages;
    }

    // FOR API VALIDATION RESPONSE
    // protected function failedValidation(Validator $validator)
    // {
    //     throw new HttpResponseException(
    //         response()->json([
    //             'errors' => $validator->errors()->all()[0],
    //             'status' => false
    //         ], 422)
    //     );
    // }
}
