<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\Location;
use App\Http\Requests\TourRequest;
use Illuminate\Support\Facades\Log; // Thêm dòng này

class TourController extends Controller
{
    //
    protected $tour;
    //
    /**
     * HomeController constructor.
     */
    public function __construct(Tour $tour, Location $location)
    {
        view()->share([
            'tour_active' => 'active',
            'status' => $tour::STATUS,
            'locations' => $location->where('l_status', 1)->get()
        ]);
        $this->tour = $tour;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $tours = Tour::with('location');
        if ($request->t_title) {
            $tours->where('t_title', 'like', '%'.$request->t_title.'%');
        }

        if ($request->t_start_date) {
            $startDate = date('Y-m-d', strtotime($request->t_start_date));
            $tours->where('t_start_date', '>=', $startDate);
        }

        if ($request->t_end_date) {
            $endDate = date('Y-m-d', strtotime($request->t_end_date));
            $tours->where('t_end_date', '<=', $endDate);
        }

        $tours = $tours->orderByDesc('id')->paginate(NUMBER_PAGINATION);
        return view('admin.tour.index', compact('tours'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.tour.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token','t_album_images');
        $request->validate([
            't_hotel_star' => 'nullable|integer|min:1|max:5',
        ]);

        try {
            $data = $request->all();
            
            // Xử lý các ngày khởi hành
            if ($request->has('t_start_date')) {
                $dates = array_filter($request->t_start_date); // Lọc bỏ các giá trị rỗng
                if (!empty($dates)) {
                    $data['t_start_date'] = json_encode($dates);
                } else {
                    $data['t_start_date'] = null;
                }
            }

            // Process main image
            if ($request->hasFile('images')) {
                $file = $request->file('images');
                if ($file->isValid()) {
                    $path = $file->store('uploads/tours', 'public');
                    $data['t_image'] = 'storage/' . $path;
                }
            }

            // Process album images
            if ($request->hasFile('t_album_images')) {
                $albumImages = [];
                foreach ($request->file('t_album_images') as $file) {
                    if ($file->isValid()) {
                        $path = $file->store('uploads/tours', 'public');
                        $albumImages[] = 'storage/' . $path;
                    }
                }
                $data['t_album_images'] = json_encode($albumImages);
            }

            // Set default values
            $data['t_user_id'] = auth()->id();
            $data['t_number_registered'] = 0;
            $data['t_view'] = 0;
            $data['t_status'] = $data['t_status'] ?? 1;

            Tour::create($data);
            return redirect()->route('tour.index')->with('success', 'Thêm tour thành công');
            
        } catch (\Exception $e) {
            Log::error('Error creating tour: ' . $e->getMessage()); // Đã sửa \Log thành Log
            return redirect()->back()
                ->withInput()
                ->with('error', 'Đã xảy ra lỗi: ' . $e->getMessage());
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
        //
        $tour = Tour::findOrFail($id);

        if (!$tour) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        return view('admin.tour.edit', compact('tour'));
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
        $data = $request->except('_token','t_album_images');
        $request->validate([
            't_hotel_star' => 'nullable|integer|min:1|max:5',
        ]);

        try {
            $tour = Tour::findOrFail($id);
            $data = $request->all();

            // Xử lý các ngày khởi hành
            if ($request->has('t_start_date')) {
                $dates = array_filter($request->t_start_date); // Lọc bỏ các giá trị rỗng
                if (!empty($dates)) {
                    $data['t_start_date'] = json_encode($dates);
                } else {
                    $data['t_start_date'] = null;
                }
            }

            // Process main image
            if ($request->hasFile('images')) {
                $file = $request->file('images');
                if ($file->isValid()) {
                    $path = $file->store('uploads/tours', 'public');
                    $data['t_image'] = 'storage/' . $path;
                }
            }

            // Process album images
            if ($request->hasFile('t_album_images')) {
                $albumImages = [];
                foreach ($request->file('t_album_images') as $file) {
                    if ($file->isValid()) {
                        $path = $file->store('uploads/tours', 'public');
                        $albumImages[] = 'storage/' . $path;
                    }
                }
                $data['t_album_images'] = json_encode($albumImages);
            }

            $tour->update($data);
            return redirect()->back()->with('success', 'Lưu dữ liệu thành công');

        } catch (\Exception $exception) {
            Log::error('Error updating tour: ' . $exception->getMessage()); // Đã sửa \Log thành Log
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
        $tour = Tour::find($id);
        if (!$tour) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        try {
            $tour->delete();
            return redirect()->back()->with('success', 'Xóa thành công');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi không thể xóa dữ liệu');
        }
    }
}
