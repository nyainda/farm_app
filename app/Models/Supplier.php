<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Supplier extends Model
{
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'city',
        'type',
        'shop_name',
        'photo',
        'serial_number',
        'account_holder',
        'account_number',
        'bank_name',
        'bank_branch',
        'product_type',
        'delivery_options',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($employee) {
            $prefix = 'SUPP';
            $uniqueNumber = strtoupper(bin2hex(openssl_random_pseudo_bytes(3)));
            $currentDate = date('Y');

            $employee->identifier = "{$prefix}/{$uniqueNumber}/{$currentDate}";
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
