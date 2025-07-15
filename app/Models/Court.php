<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Court extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'sport_id',
        'name',
        'price',
        'address',
        'address_lat',
        'address_long',
        'address_reference',
        'type',
        'max_players',
        'have_parking',
    ];

    public function sport()
    {
        return $this->belongsTo(Sport::class);
    }
} 