<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookRoom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class BookRoomController extends Controller
{
    public function myRooms()
    {
        $user = Auth::guard('users')->user();
        $bookRooms = BookRoom::with('hotel')
            ->where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->paginate(10);

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

        // Kiểm tra và hiển thị trạng thái "Đã thanh toán" cho thanh toán online
        foreach ($bookRooms as $booking) {
            if ($booking->payment && ($booking->payment->p_code_momo || $booking->payment->p_code_vnpay)) {
                if ($booking->status != 3) {  // Nếu không phải trạng thái hủy
                    $booking->status = 2;  // Set trạng thái là đã thanh toán
                }
            }
        }

        return view('page.auth.my_rooms', compact('bookRooms', 'status', 'classStatus'));
    }

    public function updateStatus(Request $request, $status, $id)
    {
        $bookRoom = BookRoom::find($id);
        if (!$bookRoom) {
            return redirect()->back()->with('error', 'Không tìm thấy đơn đặt phòng');
        }

        // Chỉ cho phép hủy khi đơn ở trạng thái tiếp nhận
        if ($bookRoom->status != 0) {
            return redirect()->back()->with('error', 'Không thể hủy đơn này. Đơn đã được xác nhận hoặc thanh toán');
        }

        DB::beginTransaction();
        try {
            // Log trước khi cập nhật
            Log::info('Updating booking status', [
                'booking_id' => $id,
                'old_status' => $bookRoom->status,
                'new_status' => $status
            ]);

            $bookRoom->status = $status;
            $bookRoom->save();

            // Send cancellation email
            if ($status == 2) {
                // Kiểm tra email có tồn tại không
                if (empty($bookRoom->email)) {
                    throw new \Exception('Email không tồn tại');
                }

                try {
                    Mail::send('emails.room-booking-cancelled', [
                        'booking' => $bookRoom,
                        'hotel' => $bookRoom->hotel,
                        'user' => $bookRoom->user
                    ], function ($message) use ($bookRoom) {
                        $message->to($bookRoom->email)
                            ->subject('Xác nhận hủy đặt phòng');
                    });
                } catch (\Exception $mailError) {
                    // Log lỗi email nhưng vẫn cho phép cập nhật trạng thái
                    Log::error('Email error: ' . $mailError->getMessage());
                }
            }

            DB::commit();
            return redirect()->back()->with('success', 'Hủy đặt phòng thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error detail: ' . $e->getMessage());
            Log::error('Error trace: ' . $e->getTraceAsString());
            return redirect()->back()->with('error', 'Không thể hủy đơn. Vui lòng liên hệ admin.');
        }
    }
}
