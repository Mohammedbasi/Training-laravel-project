<?php

namespace UserModule\app\Http\Resources;

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
            'full_name' => $this->full_name,
            'username' => $this->username,
            'is_admin' => $this->is_admin,
            'is_active' => $this->is_active,
            'address' => new AddressResource($this->address),
        ];
    }
}
