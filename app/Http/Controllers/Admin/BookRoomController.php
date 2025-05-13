<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookRoom;
use App\Models\Hotel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Mail\BookingConfirmed;
use App\Mail\BookingPaid;
use App\Mail\BookingCancelled;
use Illuminate\Support\Facades\Mail;

class BookRoomController extends Controller
{
    /**
     * Hiển thị danh sách đặt phòng
     */
    public function index(Request $request)
    {
        $query = BookRoom::with('hotel');

        if ($request->filled('hotel_name')) {
            $query->whereHas('hotel', function ($q) use ($request) {
                $q->where('h_name', 'like', '%' . $request->hotel_name . '%');
            });
        }
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }
        if ($request->filled('phone')) {
            $query->where('phone', 'like', '%' . $request->phone . '%');
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $bookRooms = $query->orderByDesc('id')->paginate(10);

        // Define status texts and CSS classes
        $status = [
            0 => 'Tiếp nhận',
            1 => 'Đã xác nhận',
            2 => 'Đã thanh toán',
            3 => 'Đã hủy'
        ];
        
        $classStatus = [
            0 => 'btn-warning',
            1 => 'btn-info',
            2 => 'btn-success',
            3 => 'btn-danger'
        ];

        return view('admin.book_room.index', compact('bookRooms', 'status', 'classStatus'));
    }

    /**
     * Lưu thông tin đặt phòng từ form gửi lên
     *
     * @param Request $request
     * @param int $id         ID của khách sạn (truyền qua URL)
     * @param string $slug    slug của khách sạn (truyền qua URL)
     */
    public function store(Request $request, $id, $slug)
    {
        // Validate dữ liệu gửi lên
        $data = $request->validate([
            'hotel_id'      => 'required|exists:hotels,id',
            'name'          => 'required|string|max:255',
            'phone'         => 'required|string|max:50',
            'address'       => 'required|string|max:255',
            'checkin_date'  => 'required|date',
            'checkout_date' => 'required|date',
            'nights'        => 'required|integer',
            'rooms'         => 'required|integer',
            'guests'        => 'required|integer',
            'email'         => 'required|email|max:255',
            'coupon'        => 'nullable|string|max:255',
        ]);

        // Gán user_id nếu người dùng đã đăng nhập
        $data['user_id'] = auth()->check() ? auth()->id() : null;

        // Lấy thông tin khách sạn để lấy giá phòng
        $hotel = \App\Models\Hotel::find($id);
        // Kiểm tra hotel tồn tại, nếu không có có thể gán giá mặc định = 0
        $roomPrice = $hotel ? $hotel->h_price : 0;

        // Tính tổng tiền: tổng tiền = số đêm * số phòng * giá phòng
        $data['total_price'] = $data['nights'] * $data['rooms'] * $roomPrice;
        // Generate room_code using a random two-digit number
        $data['room_code'] = 'MaPhong' . str_pad(rand(1, 100), 2, '0', STR_PAD_LEFT);
        // Generate booking_code in a similar format
        $data['booking_code'] = 'MaDatPhong' . str_pad(rand(1, 100), 2, '0', STR_PAD_LEFT);

        // Lưu dữ liệu vào cơ sở dữ liệu trong transaction để đảm bảo toàn vẹn
        \DB::beginTransaction();
        try {
            \App\Models\BookRoom::create($data);
            \DB::commit();
            return redirect()->back()->with('success', 'Đặt phòng thành công!');
        } catch (\Exception $exception) {
            \DB::rollBack();
            \Log::error('BookRoom store error: ' . $exception->getMessage());
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi lưu dữ liệu!');
        }
    }

    /**
     * Xóa một đặt phòng
     */
    public function delete($id)
    {
        $bookRoom = BookRoom::find($id);
        if (!$bookRoom) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        try {
            // Xóa payment nếu có
            if ($bookRoom->payment) {
                $bookRoom->payment->delete();
            }
            $bookRoom->delete();
            return redirect()->back()->with('success', 'Xóa thành công');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi không thể xóa dữ liệu');
        }
    }

    /**
     * Cập nhật trạng thái đặt phòng
     *
     * @param Request $request
     * @param int $status  Trạng thái mới (ví dụ: 0 - chưa duyệt, 1 - đã duyệt, 2 - hủy)
     * @param int $id      ID của đặt phòng
     */
    public function updateStatus(Request $request, $status, $id)
    {
        try {
            $bookRoom = BookRoom::find($id);
            if (!$bookRoom) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy đơn đặt phòng'
                ]);
            }

            // Nếu đã thanh toán online thì chỉ cho phép hủy
            if ($bookRoom->payment && ($bookRoom->payment->p_code_momo || $bookRoom->payment->p_code_vnpay)) {
                if ($status != 3) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Đơn đã thanh toán online chỉ có thể hủy'
                    ]);
                }
            } else {
                // Logic cho thanh toán thường
                $validFlow = [
                    0 => [1], // Tiếp nhận -> Đã xác nhận
                    1 => [2], // Đã xác nhận -> Đã thanh toán
                    2 => [3], // Đã thanh toán -> Đã hủy
                    3 => []   // Đã hủy là trạng thái cuối
                ];

                if (!isset($validFlow[$bookRoom->status]) || !in_array($status, $validFlow[$bookRoom->status])) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Không thể chuyển sang trạng thái này!'
                    ]);
                }
            }

            DB::beginTransaction();
            try {
                $bookRoom->status = $status;
                $bookRoom->save();
                
                // Gửi email thông báo
                if (!empty($bookRoom->email)) {
                    $emailData = [
                        'booking' => $bookRoom,
                        'hotel' => $bookRoom->hotel,
                        'user' => $bookRoom->user,
                        'bookRoom' => $bookRoom
                    ];

                    switch ($status) {
                        case 1:
                            Mail::send('emails.booking_confirmed', $emailData, function ($message) use ($bookRoom) {
                                $message->to($bookRoom->email)->subject('Xác nhận đặt phòng thành công');
                            });
                            break;
                        case 2:
                            Mail::send('emails.booking_paid', $emailData, function ($message) use ($bookRoom) {
                                $message->to($bookRoom->email)->subject('Xác nhận thanh toán thành công');
                            });
                            break;
                        case 3:
                            Mail::send('emails.booking_cancelled', $emailData, function ($message) use ($bookRoom) {
                                $message->to($bookRoom->email)
                                    ->subject('Thông báo hủy đặt phòng' . 
                                        ($bookRoom->payment ? ' và hoàn tiền' : ''));
                            });
                            break;
                    }
                }

                DB::commit();
                return response()->json(['success' => true]);
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Email sending error: ' . $e->getMessage());
                throw $e;
            }
        } catch (\Exception $e) {
            Log::error('Status update error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi khi cập nhật trạng thái'
            ]);
        }
    }
}