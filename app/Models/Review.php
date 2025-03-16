<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'ratings';
    protected $fillable = [
        'hotel_id',
        'tour_id',
        'user_id',
        'rating',
    ];

    // Relationship: A review belongs to a hotel
    public function hotel()
    {
        return $this->belongsTo(\App\Models\Hotel::class, 'hotel_id', 'id');
    }

    // Relationship: A review belongs to a tour when tour_id exists
    public function tour()
    {
        return $this->belongsTo(\App\Models\Tour::class, 'tour_id', 'id');
    }
}
