<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Teacher extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'teacher_cin',
        'teacher_first_name',
        'teacher_last_name',
        'teacher_date_of_birth',
        'teacher_place_of_birth',
        'teacher_gender',
        'teacher_address',
        'teacher_email',
        'teacher_password',
        'teacher_phone_number',
        'teacher_nationality',
        'teacher_image',
        'teacher_diploma',
    ];

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'teacher_subjects','teacher_id','subject_id');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'teacher_groups', 'teacher_id', 'group_id');
    }

    public function attendances()
    {
        return $this->hasMany(TeacherAttendance::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }
}