<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FeedingReminder extends Notification
{
    use Queueable;

    protected $message;
    protected $scheduledAt;

    public function __construct($message, $scheduledAt)
    {
        $this->message = $message;
        $this->scheduledAt = $scheduledAt;
    }

    public function via($notifiable)
    {
        return ['mail', 'database', 'sms']; // Add 'database' and 'sms' channels
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line($this->message)
            ->line('Scheduled at: ' . $this->scheduledAt);
    }


}

