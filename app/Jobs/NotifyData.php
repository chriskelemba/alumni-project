<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use App\Models\Job;
use Illuminate\Notifications\Notification;
use App\Notifications\JobPostedNotification;

class NotifyData implements ShouldQueue
{
    use Queueable, InteractsWithQueue;

    public $user;
    public $job;

    public function __construct(User $user, Job $job)
    {
        $this->user = $user;
        $this->job = $job;
    }

    public function handle()
    {
        // Send the notification to the user
        $this->user->notify(new JobPostedNotification($this->job));
    }
}