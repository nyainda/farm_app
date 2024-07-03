<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Breeding extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'type',
        'heat_date',
        'breeding_date',
        'due_date',
        'pregnancy_status',
        'offspring_count',
        'offspring_ids',
        'egg_laying_start_date',
        'egg_laying_end_date',
        'temp',
        'hatching_date',
        'no_eggs',
        'period_day',
        'humidity',
        'nesting_material',
        'light_condition',
        'environmental_conditions',
        'number_of_chicks',
        'egg_stage',
        'pupal_stage',
        'adult_stage',
        'water_ph',
        'tank_size',
        'tankSize',
        'habitat',
        'species',
        'healthCondition',
        'height',
        'color',
        'weight',
        'age',
        'feedingSchedule',
        'chick_count',
        'spawning_behavior',
        'fry_tank_setup',
        'fry_feeding',
        'spawning_substrate',
        'water_quality_monitoring',
        'date_of_breeding',
        'gender',
        'health_status',
        'breeding_history',
        'genetic_details',
        'breeding_recommendations',
        'future_breeding_plans'

    ];

    protected $dates = [
        'egg_laying_start_date',
        'egg_laying_end_date',
        'hatching_date',
        'date_of_breeding'
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }


    public function user()
{
    return $this->belongsTo(User::class);
}
public function animal()
{
    return $this->belongsTo(Animal::class, 'animal_id');
}
}
