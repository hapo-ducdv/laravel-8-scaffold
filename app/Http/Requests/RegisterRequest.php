<?php

namespace App\Http\Requests;

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
            'username' => 'required|string|min:5|max:18|unique:users,username',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,16}$/i',
            'password_confirmation' => 'required|string|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,16}$/i|same:password'
        ];
    }

    public function messages()
    {
        return [
            'username.min' => 'Please enter more than 5 characters',
            'username.max' => 'Please enter less than 18 characters',
            'username.unique' => 'This username already exists',
            'email.email' => 'Invalid email format',
            'email.unique' => 'This email already exists',
            'password.regex' => 'Please enter a password from 8 to 16 characters including uppercase, lowercase and at least one number',
            'password_confirmation.regex' => 'Please enter a password confirmation from 8 to 16 characters including uppercase, lowercase and at least one number',
            'password_confirmation.same' => 'Password incorrect'
        ];
    }
}
