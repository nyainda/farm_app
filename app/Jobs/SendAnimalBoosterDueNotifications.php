<?php

namespace App\Jobs;

use App\Models\Animal;
use App\Notifications\AnimalBoosterDueNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendAnimalBoosterDueNotifications implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $animals = Animal::whereDate('next_booster_date', now()->toDateString())->get();

        foreach ($animals as $animal) {
            $user = $animal->owner;
            $user->notify(new AnimalBoosterDueNotification($animal));
        }
    }
}
