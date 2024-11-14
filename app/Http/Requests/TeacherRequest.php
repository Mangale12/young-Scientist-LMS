<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
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
            'email'=>'required|email|unique:users,email,'.$this->route('id'),
            'phone'=>'required|unique:users,phone,'.$this->route('id'),
            'name'=>'required|string|max:255',
            'password'=>'required|string|min:8|confirmed',
            'subject_expert' => 'required',
            'teacher_id'    => 'required|unique:teachers,teacher_id,'.$this->route('id'),
        ];
    }

    public function messages(){
        return [
            
        ];
    }
}
