<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'responsible_name',
        'level_image',
        'responsible_image',
    ];

    public function sections()
    {
        return $this->hasMany(Section::class);
    }
}