<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentTypeRequest extends FormRequest
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
        // Get the branch ID if it's an update request (usually passed as a route parameter)
        $branchId = $this->route('id'); // Assumes route parameter name is 'branch'

        return [
            // Ensure 'name' is unique except for the current branch in update mode
            'name' => 'required|string|max:255|unique:document_types,name,' . $branchId,
        ];
    }

    /**
     * Custom error messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'नाम आवश्यक छ।',
            'name.unique' => 'यो नाम पहिले नै दर्ता गरिएको छ।',
        ];
    }
}
