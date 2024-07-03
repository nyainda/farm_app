<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Contact extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'city', 'county', 'postal_code', 'keywords',
        'primary_phone', 'mobile_phone', 'fax', 'company', 'country', 'contact_type',
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
