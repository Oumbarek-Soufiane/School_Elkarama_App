<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory;

    protected $fillable = [
        'evaluation_id',
        'student_id',
        'score',
        'comment',
    ];

    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}