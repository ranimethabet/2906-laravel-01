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
            'ID' => $this->id,
            'Name' => strtoupper($this->name),
            'Email' => $this->email,
            'Phone' => $this->mobile,
            // 'Roles' => $this->roles,
            'Roles' => explode(',', $this->roles),
        ];
    }
}
