<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\Animal;

class Feed extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'feeds';

    protected $fillable = [
        'amount',
        'unit',
        'feed_details',
        'feed_weight',
        'weight_unit',
        'feeding_currency',
        'estimated_cost',
        'feeding_description',
        'feeding_date',
        'repeat_days',
        'feeding_time',
        'feeder_name',
        'food_type',
        'feeding_method',
        'animal_id',
        'user_id',
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
