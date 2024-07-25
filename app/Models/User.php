<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Skill;
use App\Models\Project;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'activation_token',
        'skills',
        'profile_setup',
        'profile_picture',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
    public function getActiveAttribute()
    {
        return is_null($this->activation_token);
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'user_id');
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'user_skills', 'user_id', 'skill_id');
    }

    public function syncSkills($skills)
    {
        $this->skills()->detach();
        foreach ($skills as $skill) {
            $existingSkill = Skill::firstOrCreate(['name' => $skill]);
            $this->skills()->attach($existingSkill->id);
        }
    }

    public function notifications()
    {
        return $this->hasMany(DatabaseNotification::class, 'notifiable_id');
    }
}
