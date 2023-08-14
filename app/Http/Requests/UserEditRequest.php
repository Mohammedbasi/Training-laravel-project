<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'username' => [
                'sometimes',
                'required',
                'string',
                'min:5',
                Rule::unique('users', 'username')->ignore($this->route('user') ?? 0)
            ],
            'first_name' => [
                'string',
                'min:3',
                'max:15'
            ],
            'last_name' => [
                'string',
                'min:3',
                'max:15'
            ],
            'is_admin' => [
                Rule::in(['user' => 0, 'admin' => 1])
            ],
            'is_active' => [
                Rule::in(['inactive' => 0, 'active' => 1])
            ],
            'email' => [
                'sometimes',
                'required',
                'string',
                Rule::unique('users', 'email')->ignore($this->route('user') ?? 0),
                'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'
            ]
        ];
    }
}
