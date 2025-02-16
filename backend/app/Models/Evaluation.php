<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'subject_id',
        'teacher_id',
        'school_year_id',
        'evaluation_number',
        'type',
        'date',
        'start_time',
        'end_time',
        'description',
        'status',
        'semester',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function schoolYear()
    {
        return $this->belongsTo(SchoolYear::class);
    }

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }
}