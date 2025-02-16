<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportStaff extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'date_of_birth',
        'gender',
        'address',
        'email',
        'phone_number',
        'nationality',
        'role',
        'cin',
        'bus_id',
    ];

    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }
}