<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReactionType extends BaseModel
{
    /** @use HasFactory<\Database\Factories\ReactionTypeFactory> */
    use HasFactory;

    protected $fillable = [
        'type',
    ];


    public function reactions(): HasMany
    {
        return $this->hasMany(ReactionType::class);
    }

}
