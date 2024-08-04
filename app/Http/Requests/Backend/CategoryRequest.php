<?php

namespace App\Http\Requests\Backend;

use Illuminate\Validation\Rule;
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

        // Check if the request is for updating a category
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $categoryId = $this->route('category'); // Get the category ID from the route
            $rules['slug'] = [
                'required',
                'string',
                Rule::unique('categories', 'slug')->ignore($categoryId) // Exclude the current category slug from uniqueness check
            ];
        } else if ($this->isMethod('post') && $this->has('slug')) {
            // Create request
            $rules['slug'] = ['required', 'string', 'unique:categories,slug'];
        }
        return $rules;
    }
}
