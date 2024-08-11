<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Application;

class ApplicationApproved extends Notification
{
    use Queueable;

    protected $application;

    /**
     * Create a new notification instance.
     *
     * @param Application $application
     * @return void
     */
    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Your Application Has Been Approved')
            ->line('Congratulations! Your application for the job position at ' . $this->application->job->title . ' has been approved.')
            ->line('Thank you for your interest in working with us.')
            ->action('View Application', url('/applications/' . $this->application->id))
            ->line('If you have any questions, feel free to contact us.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'job_title' => $this->application->job->title,
            'application_url' => url('/applications/' . $this->application->id),
        ];
    }
}
