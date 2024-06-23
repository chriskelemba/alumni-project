<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'posted_by',
        'posted_on',
        'is_private',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
