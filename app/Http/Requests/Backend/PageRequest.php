<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PageRequest extends FormRequest
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
            'title' => ['required', 'max:255', 'string'],
            'description' => ['nullable', 'string'],
            'status' => ['boolean'],
        ];

        // adding unique rule conditonally
        if ($this->isMethod('post') && $this->has('slug')) {
            $rules['slug'] = ['required', 'string', 'unique:pages,slug'];
        } else if ($this->isMethod('put') || $this->isMethod('patch')  && $this->has('slug')) {
            $pageId = $this->route('page');
            $rules['slug'] = [
                'required',
                'string',
                Rule::unique('pages', 'slug')->ignore($pageId),
            ];
        }

        return $rules;
    }
}
