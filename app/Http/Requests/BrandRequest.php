<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BrandRequest extends FormRequest
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
            'name'=>[
                'required',
                Rule::unique('brands', 'name')->ignore($this->route('brand'))
            ],
            'icon'=>[
                'image',
                'mimes:jpg,png,jpeg',
                'mimetypes:image/jpg,image/png,image/jpeg'
            ],
            'notes'=>[
                'string',
            ]
        ];
    }
}
