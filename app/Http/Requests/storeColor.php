<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeColor extends FormRequest
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
            //
            'name' => 'required|max:20',
            'code' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'image.size' => 'The Image Size must not exceed from 2mb'
//            'body.required'  => 'A message is required',
        ];
    }
}
