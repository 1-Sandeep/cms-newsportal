<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'is_active' => ['boolean']
        ];


        // Add unique rule conditionally if slug is provided
        if ($this->isMethod('post') && $this->has('slug')) {
            $rules['slug'] = ['required', 'string', 'unique:categories,slug'];
        }
        if ($this->isMethod('put') && $this->has('slug')) {
            $rules['slug'] = ['required', 'string'];
        }

        return $rules;
    }
}
