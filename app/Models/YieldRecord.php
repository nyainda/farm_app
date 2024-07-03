<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class YieldRecord extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'animal_id',
        'product',
        'quantity',
        'trace_number',
        'date',
        'quality',
        'grade',
        'price',
        'batch',
        'collector',
        'yield_method',
        'feeding_description',
        'yield_time',
    ];



    protected static function boot()
    {
        parent::boot();

       // static::creating(function ($yieldrecord) {
            // Generate a UUID and set it as the 'bill_of_sale_id' attribute
           // $yieldrecord->trace_number = (string) Str::uuid();

       // });

        static::creating(function ($yieldrecord) {
            $prefix = 'Yld';
            $uniqueNumber = strtoupper(bin2hex(openssl_random_pseudo_bytes(3)));
            $currentDate = date('Y');

            $yieldrecord->trace_number  = "{$prefix}/{$uniqueNumber}/{$currentDate}";
        });


        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
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
