<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'video' => 'nullable|file|mimes:mp4,mov,flv,avi|max:1000000',
            'photo' => 'nullable|image|mimes:gif,png,jpg|max:100000',
            'file'  => 'nullable|file|max:100000',
            'post'  => 'required|string|max:300',
            'fixed' => 'required',
            'level' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'this field is required',
        ];
    }
}
