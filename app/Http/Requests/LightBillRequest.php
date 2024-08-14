<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LightBillRequest extends FormRequest
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
            'customer_id' => 'required',
            'supply_type' => 'required',
            'reading_date' => 'required|date',
            'present_reading' => 'required|integer',
            'past_reading' => 'required|integer',
            'past_amount' => 'required|numeric',
        ];
    }

    public function messages()
    {
        $messages = array(
            'customer_id.required' => 'Please Enter Customer',
            'supply_type.required' => 'Please Enter Supply Type',
            'reading_date.required' => 'Please Enter Reading Date',
            'present_reading.required' => 'Please Enter Present Reading Date',
            'past_reading.required' => 'Please Enter Past Reading Date',
            'past_amount.required' => 'Please Enter Past Amount'
        );
        return $messages;
    }
}
