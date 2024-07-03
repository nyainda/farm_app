<?php

namespace App\Console\Commands;

use App\Models\Feed;
use App\Notifications\AnimalFeedingNotification;
use Illuminate\Console\Command;

class SendAnimalFeedingNotification extends Command
{
    protected $signature = 'animal:sendfeedingnotification';
    protected $description = 'Send notifications for upcoming animal feedings';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Get upcoming feedings that are due within the next minute
        $upcomingFeedings = Feed::where('feeding_date', '<=', now()->addMinute())
            ->where('notified', false)
            ->get();

        // Send notifications for upcoming feedings
        foreach ($upcomingFeedings as $feeding) {
            $user = $feeding->user;
            $user->notify(new AnimalFeedingNotification($feeding));

            // Mark feeding as notified to avoid sending duplicate notifications
            $feeding->update(['notified' => true]);
        }

        $this->info('Animal feeding notifications sent successfully.');
    }
}
