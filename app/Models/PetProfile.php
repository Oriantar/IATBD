<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PetProfile extends Model
{
    use HasFactory;
    protected $fillable = [
        'media',
        'post_id',
        'isVideo',
    ];
    

    public function user(): BelongsTo 
{
    return $this->belongsTo(User::class);
}
}
