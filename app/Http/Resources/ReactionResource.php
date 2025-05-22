<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "ID" => $this->id,
            "User" => UserResource::make($this->user)->only(['id', 'name']),
            "Reaction Type" => ReactionTypeResource::make($this->reactionType),
            "created_at" => $this->created_at,
        ];
    }
}