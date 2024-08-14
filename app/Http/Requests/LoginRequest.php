<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'credentails' => 'required|string',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        $messages = array(
            'credentails.required' => 'Please Enter Email Or Phone number',
            'password.required' => 'Please Enter Password'
        );
        return $messages;
    }
}
