<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Student extends Authenticatable
{
    use HasApiTokens,  HasFactory, Notifiable;

    protected $fillable = [
        'guardian_id',
        'section_id',
        'group_id',
        'cne',
        'student_first_name',
        'student_last_name',
        'student_date_of_birth',
        'student_city_of_birth',
        'student_country_of_birth',
        'gender',
        'student_address',
        'student_email',
        'student_password',
        'student_phone_number',
        'student_nationality',
        'needs_transportation',
        'student_illnesses',
        'study_troubles',
        'study_troubles_description',
        'image',
    ];

    public function guardian()
    {
        return $this->belongsTo(Guardian::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function attendances()
    {
        return $this->hasMany(StudentAttendance::class);
    }

    public function absences()
    {
        return $this->hasMany(StudentAttendance::class)->where('is_present', false);
    }

    public function evaluations()
    {
        return $this->belongsToMany(Evaluation::class, 'marks')->withPivot('score', 'comment');
    }

    public function buses()
    {
        return $this->belongsToMany(Bus::class, 'student_buses', 'student_id', 'bus_id');
    }
}
