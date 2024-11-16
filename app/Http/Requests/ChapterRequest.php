<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;


class ChapterRequest extends FormRequest
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
    public function rules(Request $request)
    {
        \Log::info($request->all()); // Log incoming data
        return [
            'title' => 'required|max:255',
            'description' => 'required',
            'chapter_category_id' => 'required|exists:chapter_categories,id',
            
        ];
    }
}
