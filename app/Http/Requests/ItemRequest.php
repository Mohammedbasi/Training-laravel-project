<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ItemRequest extends FormRequest
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
            'name' => [
                'required',
                Rule::unique('items')->ignore($this->route('item'))
                    ->where(function ($query) {
                        return $query->where('brand_id', $this->input('brand_id'));
                    }),
                Rule::unique('items', 'name')->ignore($this->route('item')),

            ],
            'image' => [
                'image',
                'mimes:jpg,png,jpeg',
                'mimetypes:image/jpg,image/png,image/jpeg'
            ],
            'is_active' => [
                'required',
                Rule::in([0, 1])
            ],
            'purchasable' => [
                'required',
                Rule::in([0, 1])
            ],
            'brand_id' => [
                'required',
                'exists:brands,id',
            ],
            'price' => [
                'required',
                'numeric',
                'regex:/^\d+(\.\d{1,2})?$/'
            ]
        ];
    }
}
