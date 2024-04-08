<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class userProfile extends Model
{
    use HasFactory;

protected $fillable = [
    'media',
    'user_id',
    'isVideo',
];

public function user(): BelongsTo 
{
    return $this->belongsTo(User::class);
}

}
