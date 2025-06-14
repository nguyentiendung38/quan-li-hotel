<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Tour extends Model
{
    use HasFactory;
    protected $table = 'tours';
    public $timestamps = true;

    protected $fillable = [
        't_title',
        't_journeys',
        't_schedule',
        't_move_method',
        't_starting_gate',
        't_start_date',
        't_end_date',
        't_number_guests',
        't_price_adults',
        't_price_children',
        't_sale',
        't_view',
        't_description',
        't_content',
        't_image',
        't_album_images',
        't_location_id',
        't_user_id',
        't_number_registered',
        't_status',
        't_service_included',  // Add these
        't_notes',             // here
        't_hotel_star'
    ];

    protected $casts = [
        't_start_date' => 'array',
        't_album_images' => 'array'
    ];

    // Add this method to ensure proper date handling
    protected function setTStartDateAttribute($value)
    {
        if (empty($value)) {
            $this->attributes['t_start_date'] = json_encode([]);
        } else if (is_string($value) && is_array(json_decode($value, true))) {
            $this->attributes['t_start_date'] = $value;
        } else if (is_array($value)) {
            $this->attributes['t_start_date'] = json_encode(array_values($value));
        }
    }

    public function getTStartDateAttribute($value)
    {
        return json_decode($value, true) ?? [];
    }

    const STATUS = [
        1 => 'Khởi tạo',
        2 => 'Đang diễn ra',
        3 => 'Đã hoàn tất'
    ];

    public function createOrUpdate($request, $id = '')
    {
        $params = $request->except(['images', '_token', 'submit']);

        if (isset($request->images) && !empty($request->images)) {
            $image = upload_image('images');
            if ($image['code'] == 1)
                $params['t_image'] = $image['name'];
        }

        $params['t_user_id'] = Auth::user()->id;
        $params['t_sale'] = $request->t_sale ? $request->t_sale : 0;
        if ($id) {
            return $this->find($id)->update($params);
        }
        return $this->create($params);
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 't_location_id', 'id')->where('l_status', 1);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 't_user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'cm_tour_id', 'id');
    }

    public function booktour()
    {
        return $this->hasMany(BookTour::class, 'b_tour_id', 'id');
    }

    public function bookTours()
    {
        return $this->hasMany(BookTour::class, 'b_tour_id', 'id');
    }

    public function ratings()
    {
        return $this->hasMany(\App\Models\Rating::class, 'tour_id', 'id');
    }

    public function getAverageRatingAttribute()
    {
        return $this->ratings()->avg('rating') ?: 0;
    }

    public function getTotalRatingsAttribute()
    {
        return $this->ratings()->count();
    }
}
