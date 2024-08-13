<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Application;

class ApplicationDenied extends Notification
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
        return ['mail', 'database'];
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
            ->subject('Your Application Has Been Denied')
            ->line('We regret to inform you that your application for the job position at ' . $this->application->job->title . ' has been denied.')
            ->line('We appreciate your interest in working with us and encourage you to apply for other positions that match your qualifications.')
            ->action('View Application', url('/my-applications/'))
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
            'application_denied_url' => url('/my-applications/'),
        ];
    }
}
