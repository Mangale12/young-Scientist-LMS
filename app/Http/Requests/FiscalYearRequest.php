<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FiscalYearRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Allow the request
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'fiscal_np' => 'required|unique:fiscal_years,fiscal_np',
        ];

        // Check if the request is for updating an existing record
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            // Assume fiscal year ID is passed in the route
            $id = $this->route('id');

            // Modify the unique rule for the fiscal_np field to ignore the current fiscal year's ID
            $rules['fiscal_np'] = 'required|unique:fiscal_years,fiscal_np,' . $id;
        }

        return $rules;
    }

    /**
     * Get custom messages for validation errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'fiscal_np.required' => 'आर्थिक वर्ष अनिवार्य छ।',
            'fiscal_np.unique'   => 'यो आर्थिक वर्ष पहिले नै दर्ता भएको छ। कृपया अर्को प्रविष्ट गर्नुहोस्।',
        ];
    }
}
