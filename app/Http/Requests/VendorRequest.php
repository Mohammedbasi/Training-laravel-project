<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VendorRequest extends FormRequest
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
            'is_active' => [
                Rule::in(['inactive' => 0, 'active' => 1])
            ],
            'email' => [
                'required',
                'string',
                Rule::unique('vendors', 'email')->ignore($this->route('vendor')),
                'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'
            ],
            'phone'=>[
                'required',
                'string',
                'min:9',
                'max:15',
                Rule::unique('vendors', 'phone')->ignore($this->route('vendor')),
            ]
        ];
    }
}
