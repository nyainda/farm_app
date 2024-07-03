<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Notification extends Model
{
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false; // To specify the data type of the primary key

    protected $fillable = [

        'animal_id',
        'user_id',
        'status',
        'notification_type',
        'message',
        'feeding_reminder',
        'reminder_time',
        'feeding_notification',
        'notification_method',
        'scheduled_at',
        'sent',
        'notifiable_type',
        'read_at',
    ];

    protected $dates = ['scheduled_at']; // To specify that 'scheduled_at' should be treated as a Carbon instance

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }
}
