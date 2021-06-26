<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ExamRequest extends FormRequest
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
            'name'                => 'required',
            'level'               => 'required',
            'term'                => 'required',
            'date'                => 'required',
            'subject_id'          => 'required',
            'duration'            => 'required|numeric|min:1',
            'number_of_questions' => 'required_without:id|min:1|numeric'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'this field is required',
            'min'      => 'this field must be at least 1'
        ];
    }
}
