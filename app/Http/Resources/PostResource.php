<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'Post ID' => $this->id,
            'Post Title' => $this->title,
            'Post Content' => $this->body,
            'Reactions' => $this->reactions,
            'Comments' => CommentResource::collection($this->comments),
            // 'By' => UserResource::make($this->user),
        ];
    }
}



