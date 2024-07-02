<?php

namespace App\Models;

use App\Models\User;
use App\Models\Job;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_skills', 'skill_id', 'user_id');
    }

    public function jobs()
    {
        return $this->belongsToMany(Job::class, 'jobs_skills', 'skill_id', 'job_id');
    }
}
