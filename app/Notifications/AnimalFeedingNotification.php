<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AnimalFeedingNotification extends Notification
{
    use Queueable;

    // Define the $yieldRecord property
    protected $yieldRecord;

    /**
     * Create a new notification instance.
     *
     * @param mixed $yieldRecord
     * @return void
     */
    public function __construct($yieldRecord)
    {
        // Set the $yieldRecord property
        $this->yieldRecord = $yieldRecord;
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
                    ->subject('Animal Feeding Notification')
                    ->line('Product: ' . $this->yieldRecord->product)
                    ->line('Quantity: ' . $this->yieldRecord->quantity)
                    ->line('This is to notify you that your animal needs to be fed.')
                    ->line('Please make sure to feed your animal according to the schedule.');
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
            //
        ];
    }
}
