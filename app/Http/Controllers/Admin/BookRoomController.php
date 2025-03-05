<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookRoom;
use App\Models\Hotel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookRoomController extends Controller
{
    /**
     * Hiển thị danh sách đặt phòng
     */
    public function index(Request $request)
    {
        // Lấy danh sách đặt phòng kèm quan hệ với khách sạn
        $bookRooms = BookRoom::with('hotel')->orderByDesc('id')->paginate(10);

        // Define status texts and CSS classes
        $status = [
            0 => 'Tiếp nhận',
            1 => 'Đã xác nhận',
            2 => 'Đã thanh toán',
            3 => 'Đã hủy',
        ];
        $classStatus = [
            0 => 'btn-default',
            1 => 'btn-success',
            2 => 'btn-primary',
            3 => 'btn-danger',
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
            $bookRoom->delete();
            return redirect()->back()->with('success', 'Xóa thành công');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi không thể xóa dữ liệu');
        }
    }

    /**
     * Cập nhật trạng thái đặt phòng
     *
     * @param int $status  Trạng thái mới (ví dụ: 0 - chưa duyệt, 1 - đã duyệt, 2 - hủy)
     * @param int $id      ID của đặt phòng
     */
    public function updateStatus($status, $id)
    {
        $bookRoom = BookRoom::find($id);
        if (!$bookRoom) {
            return response()->json(['success' => false, 'message' => 'Dữ liệu không tồn tại']);
        }

        DB::beginTransaction();
        try {
            $bookRoom->status = $status;
            $bookRoom->save();
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Cập nhật trạng thái thành công']);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Đã xảy ra lỗi khi cập nhật trạng thái']);
        }
    }
}
