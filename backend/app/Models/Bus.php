<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_number',
        'seating_capacity',
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_buses', 'bus_id', 'student_id');
    }

    public function transportStaff()
    {
        return $this->hasMany(TransportStaff::class);
    }
}