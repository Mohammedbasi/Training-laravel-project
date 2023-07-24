<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InventoryRequest extends FormRequest
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
                Rule::unique('inventories')->ignore($this->route('inventory'))
                    ->where(function ($query) {
                        return $query->where('city_id', $this->input('city_id'));
                    }),
                Rule::unique('inventories', 'name')->ignore($this->route('inventory')),

            ],
            'is_active' => [
                'required',
                Rule::in([0, 1])
            ],
            'city_id' => [
                'required',
                'exists:cities,id',
            ],
            'phone'=>[
                'required',
                'string',
                'min:9',
                'max:15',
                Rule::unique('inventories', 'phone')->ignore($this->route('inventory')),
            ]
        ];
    }
}
