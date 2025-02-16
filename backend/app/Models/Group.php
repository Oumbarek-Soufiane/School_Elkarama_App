<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'section_id',
        'description',
        'capacity',
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_group');
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}