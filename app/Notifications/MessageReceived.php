<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class MessageReceived extends Notification
{
    use Queueable;

    protected $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message_id' => $this->message->id,
            'sender_name' => $this->message->sender->name,
            'message_excerpt' => \Illuminate\Support\Str::limit($this->message->content, 50),
            'message_url' => url('/messages'),
        ];
    }
}
