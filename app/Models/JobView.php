<?php

namespace App\Models;

use App\Models\Job;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobView extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
