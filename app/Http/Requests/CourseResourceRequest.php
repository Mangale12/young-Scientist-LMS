<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseResourceRequest extends FormRequest
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
            'title'=>'required|max:255|min:1|unique:course_resources,title,'.$this->route('id'),
            'description'=>'required',
            'file'=>'required|unique:course_resources,file_path,'.$this->route('id'),
        ];
    }
}
