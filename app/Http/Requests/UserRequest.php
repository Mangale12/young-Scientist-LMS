<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Allow all authorized users to make requests
    }

    public function rules()
    {
        return [
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->route('id'), // Ignore unique validation on update
            'password' => $this->isMethod('post') ? 'required|string|min:6' : 'nullable|string|min:6',
            'status_id' => 'required|integer',
            // 'status' => 'required|string',
            'ward_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|numeric',
            'branch_id' => 'required|integer',
            'position_id' => 'required|integer',
            // 'is_super_admin' => 'required|boolean',
            'profile_img' => 'nullable|image|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'प्रयोगकर्ता नाम आवश्यक छ।',
            'email.required' => 'ईमेल ठेगाना आवश्यक छ।',
            'email.email' => 'कृपया मान्य इमेल ठेगाना प्रविष्ट गर्नुहोस्।',
            'email.unique' => 'यो ईमेल पहिले नै प्रयोग भइसकेको छ।',
            'password.required' => 'पासवर्ड आवश्यक छ।',
            'password.min' => 'पासवर्ड कम्तिमा ६ वर्ण लामो हुनुपर्छ।',
            'status_id.required' => 'स्थिति आईडी आवश्यक छ।',
            'status.required' => 'स्थिति आवश्यक छ।',
            'ward_id.required' => 'वार्ड आईडी आवश्यक छ।',
            'name.required' => 'नाम आवश्यक छ।',
            'last_name.required' => 'थर आवश्यक छ।',
            'phone.required' => 'फोन नम्बर आवश्यक छ।',
            'branch_id.required' => 'शाखा आईडी आवश्यक छ।',
            'position_id.required' => 'पद आईडी आवश्यक छ।',
            'is_super_admin.required' => 'सुपर एडमिनको स्थिति आवश्यक छ।',
            'profile_img.image' => 'प्रोफाइल इमेज एक मान्य छवि फाइल हुनुपर्छ।',
            'phone.numeric' => 'फोन नम्बर हुनुपर्छ।',
        ];
    }
}
