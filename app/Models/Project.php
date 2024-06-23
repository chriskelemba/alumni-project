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
        'posted_by',
        'posted_by_name',
        'posted_on',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'posted_by');
    }
}
