<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'permission' => ['required', 'array'],
        ];

        if ($this->isMethod('post') && $this->has('slug')) {
            $rules['slug'] = ['required', 'string', 'unique:roles,slug'];
        }
        if ($this->isMethod('put') && $this->has('slug')) {
            $rules['slug'] = ['required', 'string'];
        }

        return $rules;
    }
}
