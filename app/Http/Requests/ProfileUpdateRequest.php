<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
         return [
        'username' => [
            'required',
            'string',
            'min:5',

            Rule::unique('users', 'username')->ignore($this->user()->id)
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
        'email' => [
            'required',
            'string',
            Rule::unique('users', 'email')->ignore($this->user()->id),
            'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'
        ]
    ];
    }
}
