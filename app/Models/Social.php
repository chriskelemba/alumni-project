<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Social extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'instagram',
        'youtube',
        'twitter',
        'tiktok',
        'linkedin',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
