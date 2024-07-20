<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Jobs\NotifyData;
use App\Models\User;
use App\Models\Job;

class JobServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // You need to get a user and a job instance to pass to the NotifyData constructor
        $user = User::find(1); // Replace with the actual user instance
        $job = Job::find(1); // Replace with the actual job instance

        dispatch(new NotifyData($user, $job));
    }

    public function register()
    {
        // You can register bindings or services with the container here
    }
}