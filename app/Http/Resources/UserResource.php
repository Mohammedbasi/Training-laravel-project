<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => [
                'first name' => $this->first_name,
                'last_name' => $this->last_name,
            ],
            'full name' => $this->full_name,
            'username' => $this->username,
            'is admin' => $this->is_admin,
            'is active' => $this->is_active,
            'address' => [
                'addressable id' => $this->address->addressable_id,
                'addressable type' => $this->address->addressable_type,
                'city' => $this->address->city->name,
                'district' => $this->address->district,
                'street' => $this->address->street,
                'phone' => $this->address->phone,
            ]
        ];
    }
}
