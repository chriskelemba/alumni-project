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
        'url',
        'video_url',
        'github_repo_url',
        'tools_used',
        'programming_language_used',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
