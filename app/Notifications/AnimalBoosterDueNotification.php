<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AnimalBoosterDueNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * The animal model instance.
     *
     * @var \App\Models\Animal
     */
    public $animal;

    /**
     * Create a new notification instance.
     *
     * @param \App\Models\Animal $animal
     * @return void
     */
    public function __construct($animal)
    {
        $this->animal = $animal;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Animal Booster Due')
            ->line('A booster is due for the following animal:')
            ->line('Name: ' . $this->animal->name)
            ->line('Species: ' . $this->animal->species)
            ->line('Breed: ' . $this->animal->breed)
            ->action('View Animal', url('/animals/' . $this->animal->id))
            ->line('Thank you for your attention to this matter!');
    }
}
