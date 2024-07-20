<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\JobCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\JobPostedNotification;

class NotifyUsersListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(JobCreated $event): void
    {
        $job = $event->job;

        // Get the users who have the required skills for the job
        $users = User::whereHas('skills', function ($query) use ($job) {
            $query->whereIn('skills.id', $job->skills->pluck('id'));
        })->get();

        // Notify each user
        foreach ($users as $user) {
            $user->notify(new JobPostedNotification($job));
        }
    }
}
