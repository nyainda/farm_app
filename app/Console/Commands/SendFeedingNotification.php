<?php

namespace App\Console\Commands;

use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendFeedingNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feeding:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send feeding notification';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $feedingNotification = Notification::first(); // Assuming you have only one row

        if ($feedingNotification && $feedingNotification->reminder_enabled && $feedingNotification->reminder_time) {
            $reminderTime = Carbon::parse($feedingNotification->reminder_time);

            if ($reminderTime->isToday() && $reminderTime->isFuture()) {
                if ($feedingNotification->notification_enabled && $feedingNotification->notification_method) {
                    switch ($feedingNotification->notification_method) {
                        case 'email':
                            $this->sendEmailNotification();
                            break;
                        case 'sms':
                            // Send SMS notification
                            break;
                        case 'push_notification':
                            // Send push notification
                            break;
                    }
                }
            }
        }

        return 0;
    }

    /**
     * Send email notification.
     */
    protected function sendEmailNotification()
    {
        // Logic to send email notification
        // Example: You might use Laravel's built-in notification system with Mailables
        // Replace 'YourMailableClass' with your actual Mailable class
        \Illuminate\Support\Facades\Mail::mailer('smtp')->to('recipient@example.com')->send(new YourMailableClass());
    }
}
