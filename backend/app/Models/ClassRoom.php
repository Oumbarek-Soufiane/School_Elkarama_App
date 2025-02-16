<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'description',
        'capacity',
        'type',
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}