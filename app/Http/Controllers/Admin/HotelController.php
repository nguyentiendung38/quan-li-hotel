<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Http\Requests\HotelRequest;
use App\Models\Location;

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
        //
        return view('admin.hotel.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HotelRequest $request)
    {
        $data = $request->all();
        $data['h_room_type'] = $request->input('h_room_type');

        // Xử lý ảnh đại diện
        if ($request->hasFile('h_image')) {
            $file = $request->file('h_image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/hotels'), $filename);
            $data['h_image'] = 'uploads/hotels/' . $filename;
        }

        // Xử lý album ảnh
        $albumImages = [];
        if ($request->hasFile('h_album_images')) {
            foreach ($request->file('h_album_images') as $file) {
                $albumFilename = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/hotels'), $albumFilename);
                $albumImages[] = 'uploads/hotels/' . $albumFilename;
            }
        }
        $data['h_album_images'] = json_encode($albumImages); // Lưu dưới dạng JSON

        // Lưu vào database
        Hotel::create($data);

        return redirect()->route('hotel.index')->with('success', 'Lưu dữ liệu thành công');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $hotel = Hotel::findOrFail($id);

        if (!$hotel) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        return view('admin.hotel.edit', compact('hotel'));
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
        $data = $request->all();
        $data['h_room_type'] = $request->input('h_room_type');
        if ($request->hasFile('h_image')) {
            $file = $request->file('h_image');
            $destinationPath = public_path('uploads/hotels');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $filename);
            $data['h_image'] = 'uploads/hotels/' . $filename;
        }
        // If new album images are provided, override the existing album images.
        if ($request->hasFile('h_album_images')) {
            $albumImages = [];
            foreach ($request->file('h_album_images') as $file) {
                $albumFilename = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/hotels'), $albumFilename);
                $albumImages[] = 'uploads/hotels/' . $albumFilename; // New images only
            }
            $data['h_album_images'] = json_encode($albumImages); // Override with new images
        }
        \DB::beginTransaction();
        try {
            $hotel = Hotel::findOrFail($id);
            $hotel->update($data);
            \DB::commit();
            return redirect()->route('hotel.index')->with('success', 'Lưu dữ liệu thành công');
        } catch (\Exception $exception) {
            \DB::rollBack();
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
        //
        $hotel = Hotel::find($id);
        if (!$hotel) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        try {
            $hotel->delete();
            return redirect()->back()->with('success', 'Xóa thành công');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi không thể xóa dữ liệu');
        }
    }
}
