<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Reaction extends BaseModel
{
    /** @use HasFactory<\Database\Factories\ReactionFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'reaction_type_id',
        'reactionable_type',
        'reactionable_id',
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reactionType(): BelongsTo
    {
        return $this->belongsTo(ReactionType::class);
    }

    public function type(): MorphTo
    {
        return $this->morphTo();
    }

}
