<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DartaChalaniRequest extends FormRequest
{
    public function authorize()
    {
        // Ensure the user is authorized to make this request
        return true;
    }

    public function rules()
    {
        return [
            'fiscal_year_id' => 'required|exists:fiscal_years,id',
            'subject' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'branch_id' => 'required|exists:branches,id',
            'office_id' => 'required|exists:offices,id',
            'document_type_id' => 'required|exists:document_types,id',
            'remarks' => 'nullable|string|max:500',
            'is_darta' => 'required|boolean',

            // Conditional validation: darta_no is required if is_darta is true, and chalani_no if false
            'darta_no' => 'required_if:is_darta,true|nullable|string|max:255',
            'chalani_no' => 'required_if:is_darta,false|nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'fiscal_year_id.required' => 'आर्थिक वर्ष आवश्यक छ।',
            'fiscal_year_id.exists' => 'आर्थिक वर्ष मान्य हुनुपर्छ।',
            'subject.required' => 'विषय आवश्यक छ।',
            'name.required' => 'नाम आवश्यक छ।',
            'date.required' => 'मिति आवश्यक छ।',
            'branch_id.required' => 'शाखा आवश्यक छ।',
            'document_type_id.required' => 'कागजातको प्रकार आवश्यक छ।',
            'office_id.required' => 'कार्यालय आवश्यक छ।',
            'remarks.max' => 'कैफियत ५०० अक्षर भन्दा लामो हुनुहुँदैन।',
            'is_darta.required' => 'दर्ता वा चलानीको स्थिति आवश्यक छ।',

            // Custom Nepali messages for conditional validation
            'darta_no.required_if' => 'दर्ता गर्दा दर्ता नम्बर आवश्यक छ।',
            'chalani_no.required_if' => 'चलानी गर्दा चलानी नम्बर आवश्यक छ।',
        ];
    }
}
