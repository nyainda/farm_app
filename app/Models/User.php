<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable implements MustVerifyEmail, FilamentUser
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function canAccessFilament(): bool
    {
        $allowedEmails = ['admin@example.com', 'anotheradmin@example.com', 'oyugibruce2013@gmail.com'];

        return in_array($this->email, $allowedEmails) && $this->hasVerifiedEmail();
    }


    // User.php
public function animals()
{
    return $this->hasMany(Animal::class);
}

public function treatments()
{
    return $this->hasMany(Treatment::class);
}

public function feedings()
{
    return $this->hasMany(Feed::class);
}

public function measurements()
{
    return $this->hasMany(Measurement::class);
}

public function yieldRecords()
{
    return $this->hasMany(YieldRecord::class);
}

public function notes()
    {
        return $this->hasMany(Note::class);
    }
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    public function healths()
    {
        return $this->hasMany(Health::class);

    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function breedings()
    {
        return $this->hasMany(Breeding::class);
    }
}

