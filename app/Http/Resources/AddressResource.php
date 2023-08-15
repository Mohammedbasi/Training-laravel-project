<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'addressable_id' => $this->addressable_id,
            'addressable_type' => $this->addressable_type,
            'city' => $this->city->name,
            'district' => $this->district,
            'street' => $this->street,
            'phone' => $this->phone,
        ];
    }
}
