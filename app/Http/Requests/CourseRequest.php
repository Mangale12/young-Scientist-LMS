<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
            'title'=>'required|string|unique:courses,title,'.$this->route('id'),
            'course_resource_id' => 'nullable|array',
            'course_resource_id.*' => 'exists:course_resources,id',
        ];
    }
}
