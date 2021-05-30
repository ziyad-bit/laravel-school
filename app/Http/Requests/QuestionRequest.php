<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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
            
            'exam.*.question'    => 'required|string|min:2|max:1000',
            'exam.*.choice1'     => 'required|string|min:2|max:255',
            'exam.*.choice2'     => 'required|string|min:2|max:255',
            'exam.*.choice3'     => 'max:255',
            'exam.*.choice4'     => 'max:255',
            'exam.*.choice5'     => 'max:255',
            'exam.*.correct_ans' => 'required|string|min:2|max:255',
            
        ];
    }

    public function messages()
    {
        return [
            'required'            => 'this field is required',
            'min'                 => 'you should enter at least 2 characters',
            'exam.*.question.max' => 'you should enter less than 1000 characters',
            'exam.*.choice1.max'  => 'you should enter less than 255 characters',
            'exam.*.choice2.max'  => 'you should enter less than 255 characters',
            'exam.*.choice3.max'  => 'you should enter less than 255 characters',
            'exam.*.choice4.max'  => 'you should enter less than 255 characters',
            'exam.*.choice5.max'  => 'you should enter less than 255 characters',
        ];
    }
}
