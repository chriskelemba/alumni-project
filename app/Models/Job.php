<?php

namespace App\Models;

use App\Models\Skill;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'responsibilities',
        'qualifications',
        'aboutus',
    ];

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'job_skills', 'job_id', 'skill_id');
    }

    public function syncSkills($skills)
    {
        $this->skills()->delete();
        foreach ($skills as $skill) {
            $this->skills()->create(['name' => $skill]);
        }
    }
}
