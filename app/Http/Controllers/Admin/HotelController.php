<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Http\Requests\HotelRequest;
use App\Models\Location;
use Illuminate\Support\Facades\DB;

class HotelController extends Controller
{
    protected $hotel;
    /**
     * HomeController constructor.
     */
    public function __construct(Hotel $hotel, Location $location)
    {
        view()->share([
            'hotel_active' => 'active',
            'status' => $hotel::STATUS,
            'locations' => $location->where('l_status', 1)->get()
        ]);
        $this->hotel = $hotel;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Fetch hotels data
        $hotels = Hotel::paginate(10); // Adjust the query as needed

        return view('admin.hotel.index', compact('hotels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status = $this->hotel::STATUS; // Retrieve the shared status
        $locations = Location::where('l_status', 1)->get(); // Retrieve the shared locations
        $roomTypes = [
            'standard_double' => 'Phòng tiêu chuẩn giường đôi',
            'superior_double' => 'Phòng Superior giường đôi',
            'superior_twin'   => 'Phòng Superior 2 giường đơn',
            'deluxe_double'   => 'Phòng Deluxe giường đôi',
            'deluxe_triple'   => 'Phòng Deluxe cho 3 người',
            'family_room'     => 'Phòng gia đình',
            'junior_suite'    => 'Phòng Suite Junior gia đình',
            'deluxe_quad'     => 'Phòng Deluxe cho 4 người'
        ];

        return view('admin.hotel.create', compact('status', 'locations', 'roomTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HotelRequest $request)
    {
        try {
            $data = $request->except('_token', 'submit');
            $data['h_room_type'] = $request->input('h_room_type');
            // Set a default value for h_rooms if not provided
            $data['h_rooms'] = isset($data['h_rooms']) ? $data['h_rooms'] : 0;

            // Xử lý facilities
            $data['h_facilities'] = !empty($request->h_facilities) ? json_encode($request->h_facilities) : json_encode([]);

            // Process main image using Storage
            if ($request->hasFile('h_image')) {
                $file = $request->file('h_image');
                if ($file->isValid()) {
                    // Store in the 'public/uploads/hotels' directory
                    $path = $file->store('uploads/hotels', 'public');
                    $data['h_image'] = 'storage/' . $path;
                }
            }

            // Process album images
            $albumImages = [];
            if ($request->hasFile('h_album_images')) {
                foreach ($request->file('h_album_images') as $file) {
                    if ($file->isValid()) {
                        $path = $file->store('uploads/hotels', 'public');
                        $albumImages[] = 'storage/' . $path;
                    }
                }
            }
            $data['h_album_images'] = json_encode($albumImages);

            // Save to database
            $id = Hotel::insertGetId($data);

            return redirect()->route('hotel.index')->with('success', 'Lưu dữ liệu thành công');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi lưu dữ liệu');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hotel = Hotel::findOrFail($id);

        if (!$hotel) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        $roomTypes = [
            'standard_double' => 'Phòng tiêu chuẩn giường đôi',
            'superior_double' => 'Phòng Superior giường đôi',
            'superior_twin'   => 'Phòng Superior 2 giường đơn',
            'deluxe_double'   => 'Phòng Deluxe giường đôi',
            'deluxe_triple'   => 'Phòng Deluxe cho 3 người',
            'family_room'     => 'Phòng gia đình',
            'junior_suite'    => 'Phòng Suite Junior gia đình',
            'deluxe_quad'     => 'Phòng Deluxe cho 4 người'
        ];

        return view('admin.hotel.edit', compact('hotel', 'roomTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $request->except('_token');
            $data['h_room_type'] = $request->input('h_room_type');
            $data['h_rooms'] = isset($data['h_rooms']) ? $data['h_rooms'] : 0;

            // Xử lý facilities
            $data['h_facilities'] = !empty($request->h_facilities) ? json_encode($request->h_facilities) : json_encode([]);

            if ($request->hasFile('h_image')) {
                $file = $request->file('h_image');
                if ($file->isValid()) {
                    $path = $file->store('uploads/hotels', 'public');
                    $data['h_image'] = 'storage/' . $path;
                }
            }

            if ($request->hasFile('h_album_images')) {
                $albumImages = [];
                foreach ($request->file('h_album_images') as $file) {
                    if ($file->isValid()) {
                        $path = $file->store('uploads/hotels', 'public');
                        $albumImages[] = 'storage/' . $path;
                    }
                }
                $data['h_album_images'] = json_encode($albumImages);
            }

            DB::beginTransaction();
            try {
                $hotel = Hotel::findOrFail($id);
                $hotel->update($data);
                DB::commit();
                return redirect()->route('hotel.index')->with('success', 'Lưu dữ liệu thành công');
            } catch (\Exception $exception) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Đã xảy ra lỗi khi lưu dữ liệu');
            }
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi lưu dữ liệu');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $hotel = Hotel::find($id);
        if (!$hotel) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }
        // For admin, allow deletion regardless of booking status.
        try {
            $hotel->delete();
            return redirect()->back()->with('success', 'Xóa thành công');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi không thể xóa dữ liệu');
        }
    }
}
