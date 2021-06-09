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
            'subject'          => 'required',
            'level'            => 'required',
            'term'             => 'required',
            'number_of_questions' => [
                'required',
                Rule::notIn([0]),
            ],
        ];
    }

    public function messages()
    {
        return [
            'required' => 'this field is required',
            'name.min' => 'you should enter at least 2 characters',
        ];
    }
}
