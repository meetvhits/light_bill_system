<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BillChargeRequest extends FormRequest
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
        return [
            'govt_duty_percentage' => 'required|numeric|min:0|max:100',
            'fixed_charge' => 'required|numeric|min:0',
        ];
    }
}
