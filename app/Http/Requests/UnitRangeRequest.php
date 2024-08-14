<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnitRangeRequest extends FormRequest
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
            'unit_ranges.*.start_range' => 'required|integer',
            'unit_ranges.*.end_range' => 'required|integer',
            'unit_ranges.*.price' => 'required|numeric',
        ];
    }
}
