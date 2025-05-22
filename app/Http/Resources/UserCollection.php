<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $users_count = User::count();
        $request_time = now();


        return [
            'data' => parent::toArray($request),
            'meta' => [
                'users_count' => $users_count,
                'request_time' => $request_time
            ],
        ];
    }
}