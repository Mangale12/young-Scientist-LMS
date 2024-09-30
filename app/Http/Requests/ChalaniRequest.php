<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChalaniRequest extends FormRequest
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
            'fiscal_year_id' => 'required|exists:fiscal_years,id',
            'no' => 'required|numeric',
            'subject' => 'required|string|max:255',
            'date' => 'required',
            'name' => 'required|string|max:255',
            'branch' => 'required|string|max:255',
            'remarks' => 'nullable|string',
        ];


    }

    /**
     * Get custom messages for validation errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'fiscal_year_id.required' => 'आर्थिक वर्ष आवश्यक छ।',
            'fiscal_year_id.exists' => 'आर्थिक वर्ष अवस्थित हुनुपर्छ।',
            'no.required' => 'नम्बर आवश्यक छ।',
            'no.numeric' => 'नम्बर अंकमा हुनुपर्छ।',
            'subject.required' => 'विषय आवश्यक छ।',
            'date.required' => 'मिति आवश्यक छ।',
            'name.required' => 'नाम आवश्यक छ।',
            'branch.required' => 'शाखा आवश्यक छ।',
        ];
    }
}
