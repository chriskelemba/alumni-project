<?php

namespace App\Providers;

use App\Listeners\NotifyUsersListener;
use App\Listeners\NotifyUsersWithMatchingSkills;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'App\Events\JobCreated' => [
            NotifyUsersListener::class,
        ],
    ];
}