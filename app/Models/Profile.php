<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'country',
        'state',
        'city',
        'address',
        'current_location_lat',
        'current_location_long',
        'avatar_url',
        'gender',
        'ci',
        'ci_url',
        'phone_number',
        'extra_phone_number',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 