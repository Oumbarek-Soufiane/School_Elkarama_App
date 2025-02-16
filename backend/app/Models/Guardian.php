<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Guardian extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'guardian_cin',
        'guardian_first_name',
        'guardian_last_name',
        'guardian_email',
        'guardian_password',
        'guardian_phone',
        'guardian_address',
        'guardian_gender',
        'guardian_nationality',
        'guardian_relationship',
        'second_guardian_cin',
        'second_guardian_first_name',
        'second_guardian_last_name',
        'second_guardian_email',
        'second_guardian_phone',
        'second_guardian_address',
        'second_guardian_gender',
        'second_guardian_nationality',
        'second_guardian_relationship'
    ];

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
