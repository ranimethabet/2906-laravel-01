<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Reply extends BaseModel
{
    /** @use HasFactory<\Database\Factories\ReplyFactory> */
    use HasFactory;


    protected $fillable = [
        'reply',
        'user_id',
        'comment_id',
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function comment(): BelongsTo
    {
        return $this->belongsTo(Comment::class);
    }

    public function reactions(): MorphMany
    {
        return $this->morphMany(Reaction::class, "reactionable");
    }
}