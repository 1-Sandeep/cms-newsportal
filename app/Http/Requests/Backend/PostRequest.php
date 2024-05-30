<?php

namespace App\Http\Requests\Backend;

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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'summary' => ['nullable', 'string'],
            'image' => ['image', 'max:2048', 'mimes:png,jpg,jpeg'],
            'is_published' => ['boolean'],
            'author' => ['required', 'array'],
            'category' => ['required', 'array'],
        ];
    }

    public function messages()
    {
        return [
            'image.required' => 'Please upload an image.',
            'image.image' => 'The file must be an image.',
            'image.max' => 'The image must be less than 2MB in size.',
            'image.mimes' => 'The image must be a file of type: png, jpg, jpeg.',
            'author.required' => 'Select at least one author.',
            'category.required' => 'Select at least one category.',
        ];
    }
}
