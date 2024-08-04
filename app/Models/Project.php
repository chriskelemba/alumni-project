<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'posted_by',
        'posted_on',
        'is_private',
        'is_published',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
