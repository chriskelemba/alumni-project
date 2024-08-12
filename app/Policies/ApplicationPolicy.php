<?php

namespace App\Policies;

use App\Models\Application;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ApplicationPolicy
{
    public function view(User $user, Application $application)
    {
        return $user->id === $application->user_id || $user->hasRole(['admin', 'super-admin', 'employee']);
    }
}
