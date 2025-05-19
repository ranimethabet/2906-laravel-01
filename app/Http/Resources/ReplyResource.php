<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReplyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'Reply ID' => $this->id,
            'User Reply' => $this->reply,
            'Replyed on' => $this->created_at->diffForHumans(),
        ];
    }
}
