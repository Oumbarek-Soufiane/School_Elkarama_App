<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'level_id',
        'description',
        'school_fees_per_month',
    ];

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'section_subjects')->withPivot('hours_per_week', 'coefficient');
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }
}