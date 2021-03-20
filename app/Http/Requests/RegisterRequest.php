<?php

namespace App\Http\Requests;

use App\Rules\PhoneNumberValidation;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile_number' => ['required', new PhoneNumberValidation],
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
            'password' => 'required|confirmed|min:6'
        ];
    }
}
