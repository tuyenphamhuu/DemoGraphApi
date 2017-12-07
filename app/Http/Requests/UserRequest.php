<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ];
    {
    public function message()
    {
        return [
            'email.required' => 'Please enter an email!',
            'email.email' => 'Enter the correct email format!',
            'password.required' => 'Please enter password!',
            'password.min' => 'Please enter a minimum of 6 characters!'
        ];
    }
}
