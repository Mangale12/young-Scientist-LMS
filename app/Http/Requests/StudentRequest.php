<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    
    public function authorize()
    {
        return true; // Ensure this is true if authorization is not needed
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'student_id'    => 'required|integer|unique:students,student_id,'.$this->route('id'),
            'school_id'     => 'required|exists:schools,id',
            'grade_id'      => 'required|exists:grades,id',
            'section_id'    => 'required|exists:sections,id',
            'address'       => 'required|string|max:255',
            'dob'           => 'required|date|before:today',
            'parent_phone'  => 'required|string|regex:/^\d{10}$/', // Assuming 10-digit phone format
            'parent_email'  => 'required|email|max:255|unique:students,parent_email',
        ];
    }

    /**
     * Custom messages for validation errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'student_id.required' => 'The student ID is required.',
            'student_id.integer' => 'The student ID must be an integer.',
            'student_id.unique' => 'This student ID already exists.',
            'user_id.required' => 'The user ID is required.',
            'user_id.exists' => 'The selected user ID does not exist.',
            'school_id.required' => 'The school ID is required.',
            'school_id.exists' => 'The selected school ID does not exist.',
            'grade_id.required' => 'The grade ID is required.',
            'grade_id.exists' => 'The selected grade ID does not exist.',
            'section_id.required' => 'The section ID is required.',
            'section_id.exists' => 'The selected section ID does not exist.',
            'address.required' => 'The address is required.',
            'dob.required' => 'The date of birth is required.',
            'dob.date' => 'The date of birth must be a valid date.',
            'dob.before' => 'The date of birth must be a date before today.',
            'parent_phone.required' => 'The parent\'s phone number is required.',
            'parent_phone.regex' => 'The parent\'s phone number must be a 10-digit number.',
            'parent_email.required' => 'The parent\'s email is required.',
            'parent_email.email' => 'The parent\'s email must be a valid email address.',
            'parent_email.unique' => 'This parent email is already registered.',
        ];
    }
}
