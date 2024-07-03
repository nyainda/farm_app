<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Task extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'title',
        'start_date',
        'start_hour',
        'start_minute',
        'end_hour',
        'end_minute',
        'start_time',
        'end_date',
        'end_time',
        'description',
        'associated_to',
        'color',
        'status',
        'priority',
        'repeats',
        'repeat_frequency',
        'end_repeat_date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($task) {
            // Generate a UUID and set it as the 'bill_of_sale_id' attribute
            $task->associated_to = Str::uuid();
        });
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

    public function user()
{
    return $this->belongsTo(User::class);
}
}
