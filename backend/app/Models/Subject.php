<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_subject');
    }

    public function sections()
    {
        return $this->belongsToMany(Section::class, 'section_subjects')->withPivot('hours_per_week', 'coefficient');
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }
}