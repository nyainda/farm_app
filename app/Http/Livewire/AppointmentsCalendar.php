<?php

namespace App\Http\Livewire;

use App\Models\Model;
use Livewire\Component;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;
use Asantibanez\LivewireCalendar\LivewireCalendar;

class AppointmentsCalendar extends LivewireCalendar
{
    public function events(): Collection
    {
        return Model::query()
            ->whereDate('scheduled_at', '>=', $this->gridStartsAt)
            ->whereDate('scheduled_at', '<=', $this->gridEndsAt)
            ->get()
            ->map(function (Model $model) {
                return [
                    'id' => $model->id,
                    'title' => $model->title,
                    'description' => $model->notes,
                    'date' => $model->scheduled_at,
                    'backgroundColor' => '#3490dc',
                    'borderColor' => '#2779bd',
                    'textColor' => '#ffffff',
                    'allDay' => true,
                    'start' => Carbon::parse($model->scheduled_at)->format('Y-m-d\TH:i:s'),
                    'end' => Carbon::parse($model->scheduled_at)->addHour()->format('Y-m-d\TH:i:s'),
                    'tooltip' => $model->title . ' - ' . $model->notes,
                ];
            });
    }


}


