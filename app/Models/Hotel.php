<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Hotel extends Model
{
    use HasFactory;
    protected $table = 'hotels';
    public $timestamps = true;

    const STATUS = [
        1 => 'Xuất bản',
        2 => 'Bản nháp'
    ];

    protected $fillable = [
        'h_name',
        'h_image',
        'h_album_images',
        'h_address',
        'h_phone',
        'h_number_people',
        'h_price',
        'h_sale',
        'h_description',
        'h_content',
        'h_status',
        'h_start_date',
        'h_end_date',
        'h_location_id',
        'h_user_id',
        'h_rooms',
        'h_room_type', // Added room type field for mass assignment
        'h_facilities'
    ];

    // Thêm mapping tiện nghi
    public static $facilityNames = [
        'wifi' => 'Wifi miễn phí',
        'parking' => 'Bãi đậu xe',
        'pool' => 'Hồ bơi',
        'restaurant' => 'Nhà hàng',
        'gym' => 'Phòng tập gym',
        'spa' => 'Spa & Massage',
        'air_conditioning' => 'Điều hòa',
        'elevator' => 'Thang máy',
        'non_smoking' => 'Phòng không hút thuốc'
    ];

    public function location()
    {
        return $this->belongsTo(Location::class, 'h_location_id', 'id')->where('l_status', 1);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'h_user_id', 'id');
    }

    public function createOrUpdate($request, $id = '')
    {
        $params = $request->except(['images', '_token', 'submit']);

        if (isset($request->images) && !empty($request->images)) {
            $image = upload_image('images');
            if ($image['code'] == 1)
                $params['h_image'] = $image['name'];
        }

        $params['h_user_id'] = Auth::user()->id;
        if ($id) {
            return $this->find($id)->update($params);
        }
        return $this->create($params);
    }

    public function scopeActive($query)
    {
        return $query->where('h_status', 1);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'cm_hotel_id', 'id');
    }

    public function bookRooms()
    {
        return $this->hasMany(BookRoom::class, 'hotel_id', 'id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function getAverageRatingAttribute()
    {
        return $this->ratings()->avg('rating') ?? 0;
    }

    public function getTotalRatingsAttribute()
    {
        return $this->ratings()->count();
    }

    public function getRoomTypeNameAttribute()
    {
        $types = [
            'standard_double' => 'Phòng tiêu chuẩn giường đôi',
            'superior_double' => 'Phòng Superior giường đôi',
            'superior_twin' => 'Phòng Superior 2 giường đơn',
            'deluxe_double' => 'Phòng Deluxe giường đôi',
            'deluxe_triple' => 'Phòng Deluxe cho 3 người',
            'family_room' => 'Phòng gia đình',
            'junior_suite' => 'Phòng Suite Junior gia đình',
            'deluxe_quad' => 'Phòng Deluxe cho 4 người'
        ];
        return $types[$this->h_room_type] ?? 'Chưa chọn';
    }

    // Thêm accessor để lấy tên tiện nghi đã được dịch
    public function getTranslatedFacilitiesAttribute()
    {
        $facilities = json_decode($this->h_facilities ?? '[]', true);
        return array_map(function($facility) {
            return self::$facilityNames[$facility] ?? $facility;
        }, $facilities);
    }
}
