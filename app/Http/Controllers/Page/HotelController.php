<?php

namespace App\Http\Controllers\Page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\BookRoom;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
use App\Models\Hotel;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmation;
use Illuminate\Support\Facades\Log; // Add this line
use App\Mail\AdminHotelBookingMail; // ensure this line exists
use App\Mail\CustomerHotelBookingMail; // Thêm use statement này

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
        
        // Added filter for room_type
        if ($request->room_type) {
            $hotels->where('h_room_type', $request->room_type);
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
        $hotel = Hotel::with(['comments' => function($query) use ($id) {
            $query->with(['user', 'replies' => function($q) {
                $q->with('user')->limit(10);
            }])->where('cm_hotel_id', $id)->limit(20)->orderByDesc('id');
        }])->find($id);

        if (!$hotel) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        // Decode facilities for display
        $hotel->h_facilities = json_decode($hotel->h_facilities ?? '[]'); // Ensure this line exists

        $hotels = Hotel::with('user')->where(['h_location_id' => $hotel->h_location_id])
            ->where('id', '<>', $id)->active()->orderByDesc('id')->limit(NUMBER_PAGINATION_PAGE)->get();

        return view('page.hotel.detail', compact('hotel', 'hotels'));
    }

    public function bookTour()
    {
        return view('page.tour.book');
    }

    public function paymentOnline(Request $request, $id)
    {
        $hotel = Hotel::findOrFail($id);
        
        // Kiểm tra số phòng còn trống
        $bookedRooms = $hotel->bookRooms->where('status', '!=', 2)->sum('rooms');
        $availableRooms = $hotel->h_rooms - $bookedRooms;

        if ($request->rooms > $availableRooms) {
            return redirect()->back()->with('error', 'Rất tiếc, chỉ còn ' . $availableRooms . ' phòng trống');
        }

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
            'note' => 'nullable|string|max:500', // Thêm validate cho note
            'agreePolicy' => 'required'
        ]);

        $data['hotel_id'] = $hotel->id;
        $data['user_id'] = Auth::guard('users')->id();
        $data['total_price'] = $hotel->h_price * $data['nights'] * $data['rooms'];
        $data['status'] = 0;
        $data['note'] = $request->note; // Thêm note vào data

        $booking = BookRoom::create($data);
        
        // Gửi email xác nhận
        try {
            Mail::to($booking->email)->send(new BookingConfirmation($booking, $data['total_price']));
        } catch (\Exception $e) {
            Log::error('Không thể gửi email: ' . $e->getMessage());
        }

        return redirect()->route('get.from.payment.hotel', $booking->id);
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
            'agreePolicy' => 'required',
            'note' => 'nullable|string|max:500', // Thêm validate cho note
        ]);

        $data['hotel_id'] = $hotel->id;
        $data['user_id'] = Auth::guard('users')->id();
        $data['total_price'] = $hotel->h_price * $data['nights'] * $data['rooms'];
        $data['status'] = 0;
        $data['note'] = $request->note; // Thêm note vào data

        $booking = BookRoom::create($data);
        
        return redirect()->route('hotel.detail', ['id' => $hotel->id, 'slug' => $slug])
                        ->with('success', 'Đặt phòng thành công!');
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

    // Hiển thị form thanh toán cho đơn đặt phòng khách sạn
    public function getFromPayment($id)
    {
        $booking = \App\Models\BookRoom::with('hotel')->find($id);
        if (!$booking) {
            return redirect()->back()->with('error', 'Không tìm thấy đơn đặt phòng.');
        }
        // Tính giá sau khuyến mãi
        if ($booking->hotel->h_sale > 0) {
            $priceAfterDiscount = $booking->hotel->h_price - ($booking->hotel->h_price * $booking->hotel->h_sale / 100);
            $totalMoney = $priceAfterDiscount * $booking->rooms * $booking->nights;
        } else {
            $totalMoney = $booking->total_price;
        }
        session(['booking_id' => $booking->id]);
        return view('page.vnpay.bookingHotel', compact('booking', 'totalMoney'));
    }
    

    // Tạo phương thức thanh toán (VNPay) cho đặt phòng khách sạn
    public function createPayMent(Request $request)
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('vnpay.return.hotel');
        $vnp_TmnCode = "KZYZ0PPO";
        $vnp_HashSecret = "47SKX7IX1UAFALKDUYV9XQ06MA8AKKF6";

        $bookingId = session('booking_id');
        $booking = \App\Models\BookRoom::with('hotel')->find($bookingId);
        if (!$booking) {
            return redirect()->back()->with('error', 'Không tìm thấy đơn đặt phòng.');
        }

        // Tính lại giá sau khuyến mãi
        if ($booking->hotel->h_sale > 0) {
            $priceAfterDiscount = $booking->hotel->h_price - ($booking->hotel->h_price * $booking->hotel->h_sale / 100);
            $totalMoney = $priceAfterDiscount * $booking->rooms * $booking->nights;
        } else {
            $totalMoney = $booking->total_price;
        }

        $vnp_TxnRef = $booking->id . '_' . time();
        $payment = \App\Models\Payment::create([
            'p_transaction_id'   => $booking->id,
            'p_user_id'          => auth()->id(),
            'p_money'            => $totalMoney, // Sử dụng giá đã giảm
            'p_transaction_code' => $vnp_TxnRef,
            'p_note'             => 'Thanh toán cho booking #' . $booking->id,
        ]);

        $vnp_OrderInfo = 'Thanh toán đặt phòng khách sạn #' . $booking->id;
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $totalMoney * 100; // Sử dụng giá đã giảm
        $vnp_Locale = 'vn';
        $vnp_BankCode = '';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = [
            "vnp_Version"    => "2.1.0",
            "vnp_TmnCode"    => $vnp_TmnCode,
            "vnp_Amount"     => $vnp_Amount,
            "vnp_Command"    => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode"   => "VND",
            "vnp_IpAddr"     => $vnp_IpAddr,
            "vnp_Locale"     => $vnp_Locale,
            "vnp_OrderInfo"  => $vnp_OrderInfo,
            "vnp_OrderType"  => $vnp_OrderType,
            "vnp_ReturnUrl"  => $vnp_Returnurl,
            "vnp_TxnRef"     => $vnp_TxnRef,
        ];

        ksort($inputData);
        $query = "";
        $hashdata = "";
        $i = 0;
        foreach ($inputData as $key => $value) {
            $hashdata .= ($i++ > 0 ? '&' : '') . urlencode($key) . "=" . urlencode($value);
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        $vnp_Url = $vnp_Url . "?" . $query;
        if ($vnp_HashSecret) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        // Luôn redirect sang VNPay
        return redirect($vnp_Url);
    }

    // Nhận callback từ VNPay cho booking khách sạn
    public function vnPayReturn(Request $request)
    {
        Log::info('VNPay callback:', $request->all());

        $vnp_TxnRef = $request->get('vnp_TxnRef');
        $vnp_ResponseCode = $request->get('vnp_ResponseCode');
        $vnp_TransactionStatus = $request->get('vnp_TransactionStatus');
        $vnp_BankCode = $request->get('vnp_BankCode');
        $vnp_PayDate = $request->get('vnp_PayDate');

        $payment = \App\Models\Payment::where('p_transaction_code', $vnp_TxnRef)->first();
        if (!$payment) {
            return redirect()->route('page.home')->with('error', 'Giao dịch không tồn tại.');
        }
        $payment->p_vnp_response_code = $vnp_ResponseCode;
        $payment->p_code_vnpay = $vnp_TransactionStatus;
        $payment->p_code_bank = $vnp_BankCode;
        $payment->p_time = $vnp_PayDate;
        $payment->save();

        // Only mark success if a secure hash is verified (simulate a more robust check)
        if ($vnp_ResponseCode === '00' && $vnp_TransactionStatus === '00' && $request->has('vnp_SecureHash')) {
            // Lấy thông tin booking
            $booking = BookRoom::with('hotel')->find($payment->p_transaction_id);
            
            // Tính giá gốc và giá sau khuyến mãi
            $originalPrice = $booking->hotel->h_price * $booking->rooms * $booking->nights;
            $discountedPrice = $originalPrice;
            
            if ($booking->hotel->h_sale > 0) {
                $discountedPrice = $originalPrice - ($originalPrice * $booking->hotel->h_sale / 100);
            }
            
            // Gửi email xác nhận thanh toán thành công
            try {
                Mail::to($booking->email)->send(new BookingConfirmation($booking, [
                    'originalPrice' => $originalPrice,
                    'discountedPrice' => $discountedPrice,
                    'discountPercent' => $booking->hotel->h_sale
                ]));
            } catch (\Exception $e) {
                Log::error('Không thể gửi email: ' . $e->getMessage());
            }

            return redirect()->route('page.home')->with('success', 'Thanh toán thành công!');
        } else {
            // During testing, you may want to redirect to the payment page for further review
            return redirect()->route('get.from.payment.hotel', $payment->p_transaction_id)
        ->with('error', 'Thông tin thanh toán chưa xác minh, vui lòng kiểm tra lại!');
        }
    }

    public function booking(Request $request)
    {
        $validated = $request->validate([
            'hotel_id' => 'required',
            'fullname' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'rooms' => 'required|integer|min:1',
            'note' => 'nullable|string',
        ]);

        $hotel = Hotel::find($request->hotel_id);
        if (!$hotel) {
            return redirect()->back()->with('error', 'Không tìm thấy khách sạn');
        }

        $bookingData = $validated;
        $bookingData['hotel_name'] = $hotel->h_name;
        $bookingData['room_type'] = $hotel->h_room_type;
        $bookingData['price'] = $hotel->h_price * (1 - $hotel->h_sale / 100);

        try {
            // Chỉ gửi email cho admin và khách hàng, không lưu vào database
            Mail::to('nguyendunghk789@gmail.com')->send(new AdminHotelBookingMail($bookingData));
            Mail::to($validated['email'])->send(new CustomerHotelBookingMail($bookingData));

            return redirect()->back()->with('success', 'Đặt phòng thành công. Vui lòng kiểm tra email để xác nhận.');
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại sau.');
        }
    }
}
