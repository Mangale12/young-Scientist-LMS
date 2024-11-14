<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Allows all users to make this request
    }

    public function rules()
    {
        return [
            'old_password' => 'required|string|min:6',
            'password'     => 'required|string|min:6|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'old_password.required' => 'पुरानो पासवर्ड आवश्यक छ।',
            'old_password.min'      => 'पुरानो पासवर्ड कम्तिमा ६ अक्षर लामो हुनुपर्छ।',
            'password.required'     => 'नयाँ पासवर्ड आवश्यक छ।',
            'password.min'          => 'नयाँ पासवर्ड कम्तिमा ६ अक्षर लामो हुनुपर्छ।',
            'password.confirmed'    => 'नयाँ पासवर्ड र पासवर्ड सुनिश्चितता मेल खाँदैन।',
        ];
    }
}

