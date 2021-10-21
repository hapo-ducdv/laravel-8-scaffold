<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
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
            'avatar' => 'image',
            'update_phone' => 'nullable|numeric|unique:users,phone|regex:/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/',
        ];
    }


    public function messages()
    {
        return [
            'avatar.image' => 'Upload file format is not correct (jpg, jpeg, png, bmp, gif, svg, or webp)',
            'update_phone.numeric' => 'The phone number must be numeric',
            'update_phone.unique' => 'This phone number already exists',
            'update_phone.regex' => 'Invalid phone number',
        ];
    }
}
