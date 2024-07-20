<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Job;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Notifications\Notification;

class Notify implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user;
    private $job;

    public function __construct(User $user, Job $job)
    {
        $this->user = $user;
        $this->job = $job;
    }

    public function handle()
    {
        $this->user->notify(new JobPostedNotification($this->job, 1)); // Pass the type parameter
    }
}