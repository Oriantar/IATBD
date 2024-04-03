<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'pet',
        'message',
        'bedrag',
        'starthuur',
        'eindhuur',
        'species',
        'image',
        'user_id',
        'review',
    ];

    public function user(): BelongsTo 
    {
        return $this->belongsTo(User::class);
    }
    public function aanvraag(): HasMany
    {
        return $this->hasMany(Aanvraag::class);
    }
}
