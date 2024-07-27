<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        // Initialize base rules
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'status' => ['boolean'],
            'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg'],
            'role' => ['nullable', 'array'],
        ];

        // Add additional rules for POST method
        if ($this->isMethod('post')) {
            $rules['email'] = ['required', 'email', 'string', 'max:255', 'unique:users'];
            $rules['password'] = ['required', 'min:8', 'confirmed', 'string'];
            $rules['password_confirmation'] = ['required', 'same:password', 'string'];
        }

        // Add additional rules for PUT method
        if ($this->isMethod('put')) {
            $userId = $this->route('id'); // Assuming the route parameter is 'id'
            // $rules['email'] = ['required', 'email', 'string', 'max:255', 'unique:users,email,' . $userId];
            $rules['password'] = ['nullable', 'min:8', 'confirmed', 'string'];
            $rules['password_confirmation'] = ['nullable', 'same:password', 'string'];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'image.image' => 'The file must be an image.',
            'image.max' => 'The image must be less than 2MB in size.',
            'image.mimes' => 'The image must be a file of type: png, jpg, jpeg.',
        ];
    }
}
