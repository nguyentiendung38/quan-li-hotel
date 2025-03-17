<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id',
        'user_id',
        'name',
        'phone',
        'address',
        'email',
        'checkin_date',
        'checkout_date',
        'nights',
        'rooms',
        'guests',
        'total_price',
        'status',
        'note',
        'coupon',
        'room_code',
        'booking_code'
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function getTotalPriceWithDiscountAttribute()
    {
        $totalPrice = $this->total_price;
        if ($this->coupon) {
            $totalPrice *= 0.95; // Apply 5% discount
        }
        return $totalPrice;
    }
}
