<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Health extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'vaccination_status',
        'vet_contact_id',
        'medical_history',
        'dietary_restrictions',
        'neutered_spayed',
        'regular_medication',
        'last_vet_visit',
        'insurance_details',
        'exercise_requirements',
        'parasite_prevention',
        'vaccine_name',
        'date_administered',
        'dosage',
        'administered_by',
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
