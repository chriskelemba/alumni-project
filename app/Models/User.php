<?php

namespace App\Models;

use App\Models\Skill;
use App\Models\Social;
use App\Models\Project;
use App\Models\Portfolio;
use App\Models\Application;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'phone_number',
        'location',
        'password',
        'activation_token',
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
        if (is_null($skills)) {
            $skills = [];
        }
        
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

    public function portfolio(): HasOne
    {
        return $this->hasOne(Portfolio::class);
    }

    public function socials()
    {
        return $this->hasOne(Social::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
