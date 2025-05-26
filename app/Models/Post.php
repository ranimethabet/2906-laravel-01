<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;


class Post extends BaseModel
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    // Use fillable or guarded
    // NOTE: fillable is safer than guarded, but guarded is easier to use
    // Because we are using fillable, we need to add the fields to the fillable array in the model

    protected $fillable = [
        'title',
        'body',
        'post_status_id',
        'user_id',
    ];

    // protected $guarded = [];

    // Relationships

    public function post_status(): BelongsTo
    {
        return $this->belongsTo(PostStatus::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }


    public function reactions(): MorphMany
    {
        return $this->morphMany(Reaction::class, "reactionable");
    }
}