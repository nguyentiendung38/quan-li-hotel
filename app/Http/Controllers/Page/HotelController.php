<?php

namespace App\Http\Controllers\Page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\BookRoom;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
use App\Models\Hotel;



class HotelController extends Controller
{
    //
    public function index(Request $request)
    {
        $hotels = Hotel::with('user');

        if ($request->key_hotel) {
            $hotels->where('h_name', 'like', '%'.$request->key_hotel.'%');
        }

        if ($request->location_id) {
            $hotels->where('h_location_id', $request->location_id);
        }

        if ($request->price) {
            $price = explode('-', $request->price);
            $hotels->whereBetween('h_price', [$price[0], $price[1]]);
        }

        $hotels = $hotels->active()->orderByDesc('id')->paginate(NUMBER_PAGINATION_PAGE);
        $locations = Location::where('l_status', 1)->get();
        return view('page.hotel.index', compact('hotels', 'locations'));
    }

    public function detail(Request $request, $id)
    {
        $hotel = Hotel::with(['comments' => function($query) use ($id){
            $query->with(['user', 'replies' => function($q) {
                $q->with('user')->limit(10);
            }])->where('cm_hotel_id', $id)->limit(20)->orderByDesc('id');
        }])->find($id);
        if (!$hotel) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        $hotels = Hotel::with('user')->where(['h_location_id' => $hotel->h_location_id])->where('id', '<>', $id)->active()->orderByDesc('id')->limit(NUMBER_PAGINATION_PAGE)->get();
        return view('page.hotel.detail', compact('hotel', 'hotels'));
    }

    public function bookTour()
    {
        return view('page.tour.book');
    }

    public function postBookRoom(Request $request, $id, $slug)
    {
        $hotel = Hotel::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'checkin_date' => 'required|date',
            'checkout_date' => 'required|date',
            'nights' => 'required|integer',
            'rooms' => 'required|integer',
            'guests' => 'required|integer',
            'email' => 'required|email',
            'agreePolicy' => 'required'
        ]);

        $data['hotel_id'] = $hotel->id;
        $data['user_id'] = Auth::id()()->id();
        $data['total_price'] = $hotel->h_price * $data['nights'] * $data['rooms'];
        $data['status'] = 0; // Trạng thái "Tiếp nhận"

        BookRoom::create($data);

        return redirect()->route('hotel.detail', ['id' => $hotel->id, 'slug' => $slug])->with('success', 'Đặt phòng thành công!');
    }

    public function rateHotel(Request $request, $id)
    {
        if (!Auth::guard('users')->check()) {
            return redirect()->back()->with('error', 'Bạn cần đăng nhập để đánh giá');
        }

        $hotel = Hotel::find($id);
        if (!$hotel) {
            return redirect()->back()->with('error', 'Không tìm thấy khách sạn');
        }

        $rating = new Rating();
        $rating->hotel_id = $id;
        $rating->user_id = Auth::guard('users')->id();
        $rating->rating = $request->rating;
        $rating->save();

        return redirect()->back()->with('success', 'Đánh giá của bạn đã được gửi thành công');
    }
}
