<?php

namespace App\Notifications;

use App\Models\Job;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class JobPostedNotification extends Notification
{
    use Queueable;

    public $job;
    public $user;

    /**
     * Create a new notification instance.
     *
     * @param  \App\Job  $job
     */
    public function __construct(Job $job, User $user)
    {
        $this->job = $job;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = url('jobs/'.$this->job->id.'/show');

        return (new MailMessage)
                    ->subject('A Job Has Been Posted')
                    ->greeting('Hello, '.$this->user->name)
                    ->line("A new job has been posted: {$this->job->title}")
                    ->action('View Job', $url)
                    ->line("You have been notified because you have the required skills for this job.");
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'job_title' => $this->job->title,
            'job_description' => $this->job->description,
            'job_url' => url('jobs/'.$this->job->id.'/show'),
            'notifiable_type' => get_class($this->user),
            'notifiable_id' => $notifiable->id,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}