<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Aanvraag extends Model
{
    use HasFactory;

    protected $fillable = [
        'accepted',
        'post_id',
        'user_id',
    ];

    public function caretaker(): BelongsTo 
    {
        return $this->belongsTo(User::class);
    }
    public function post(): BelongsTo 
    {
        return $this->belongsTo(Post::class);
    }
}
