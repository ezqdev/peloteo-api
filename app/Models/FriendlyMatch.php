<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FriendlyMatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'sport_id',
        'court_id',
        'date',
        'hour',
        'status',
    ];

    public function sport()
    {
        return $this->belongsTo(Sport::class);
    }

    public function court()
    {
        return $this->belongsTo(Court::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
} 