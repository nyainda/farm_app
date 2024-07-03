<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Employee extends Model
{
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    use HasFactory;

    protected $fillable =[

        'name',
        'email',
        'phone',
        'address',
        'city',
        'role',
        'start_date',
        'salary',
        'identifier',
        'nid_no',
        'photo',


    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($employee) {
            $role = $employee->role;

            // Define role-specific prefixes
            $rolePrefixes = [
                'employee' => 'EMP',
                'manager' => 'MGR',
                'admin' => 'ADM',
                'supervisor' => 'SUP',
                'assistant' => 'AST',
                'analyst' => 'ANL',
                'animal caregiver' => 'ACG',
                'herd manager' => 'HMG',
                'pasture supervisor' => 'PSV',
                'feed manager' => 'FDM',
                'breeding specialist' => 'BSP',
                'health technician' => 'HTC',
                'veterinary assistant' => 'VTA',
                'milker' => 'MLK',
                'farrier' => 'FRR',
                'livestock handler' => 'LHV',
                'animal nutritionist' => 'ANU',
                'farm supervisor' => 'FSV',
                'farm manager' => 'FMM',
                'livestock inspector' => 'LVI',
                'animal behaviorist' => 'ABH',
                'farm educator' => 'FED',
                'animal welfare officer' => 'AWO',
            ];


            // Use the role-specific prefix or a default prefix
            $prefix = $rolePrefixes[$role] ?? 'OTH';

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

// Animal.php
public function employees()
{
    return $this->belongsToMany(Employee::class)->withPivot('role');
}


}
