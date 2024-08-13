<?php

namespace App\Models;

use App\Models\Skill;
use App\Models\JobView;
use App\Models\Application;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'company',
        'location',
        'description',
        'responsibilities',
        'qualifications',
        'aboutus',
        'logo',
    ];

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'job_skills', 'job_id', 'skill_id');
    }

    public function syncSkills($skills)
    {
        if (is_null($skills)) {
            $skills = [];
        }
        
        $this->skills()->detach();
        foreach ($skills as $skill) {
            $existingSkill = Skill::firstOrCreate(['name' => $skill]);
            $this->skills()->attach($existingSkill->id);
        }
    }

    public function views()
    {
        return $this->hasMany(JobView::class);
    }

    public function getViewCountAttribute()
    {
        return $this->views()->count();
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
