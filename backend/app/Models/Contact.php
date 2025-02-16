<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable=[
        "contact_first_name",
        "contact_last_name",
        "contact_telephone",
        "contact_email",
        "message",
    ];
}
