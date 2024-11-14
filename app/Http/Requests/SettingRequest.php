<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'site_name'      => 'required|string|max:255',
            'site_email'          => 'required|email|max:255',
            'site_contact'   => 'required|string|max:255',
            'site_phone'          => 'required|string|max:20',
            'site_mobile'         => 'required|string|max:20',
            'site_first_address'        => 'nullable|string|max:255',
            'site_second_address' => 'nullable|string|max:255',
            'logo'           => 'nullable|image|max:2048', // Allow image upload, max 2MB
        ];
    }

    public function messages()
    {
        return [
            
        ];
    }
}
