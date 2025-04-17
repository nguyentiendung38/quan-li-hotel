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
use Illuminate\Support\Facades\Log;
use App\Mail\AdminHotelBookingMail;
use App\Mail\CustomerHotelBookingMail;
use App\Mail\HotelBookingConfirmation;
use App\Mail\MomoPaymentHotel;
use Illuminate\Support\Facades\File;

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
    public function comment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string',
            'comment_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            $commentData = [
                'cm_user_id' => Auth::guard('users')->id(),
                'cm_content' => $request->comment,
                'cm_hotel_id' => $id,
                'cm_tour_id' => null
            ];

            // Handle image upload
            if ($request->hasFile('comment_image')) {
                $image = $request->file('comment_image');
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                
                // Create comments directory if it doesn't exist
                $uploadPath = public_path('uploads/comments');
                if (!File::exists($uploadPath)) {
                    File::makeDirectory($uploadPath, 0777, true);
                }
                
                // Move the uploaded file
                $image->move($uploadPath, $imageName);
                $commentData['cm_image'] = 'uploads/comments/' . $imageName;
            }

            $hotel = Hotel::findOrFail($id);
            $comment = $hotel->comments()->create($commentData);

            return back()->with('success', 'Bình luận của bạn đã được gửi thành công!');
        } catch (\Exception $e) {
            \Log::error('Comment Error: ' . $e->getMessage());
            return back()->with('error', 'Có lỗi xảy ra khi gửi bình luận.');
        }
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

        // Kiểm tra xem người dùng đã xem bài này trong session chưa
        $viewedHotels = session('viewed_hotels', []);
        if (!in_array($id, $viewedHotels)) {
            // Chỉ tăng view khi người dùng chưa xem trong session hiện tại
            $hotel->increment('h_view');
            // Thêm ID khách sạn vào danh sách đã xem
            $viewedHotels[] = $id;
            session(['viewed_hotels' => $viewedHotels]);
        }

        // Decode facilities for display
        $hotel->h_facilities = json_decode($hotel->h_facilities ?? '[]');

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
        // Remove payment creation from here since it will be created in callback
        
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
        
        // Update payment information
        $payment->p_vnp_response_code = $vnp_ResponseCode;
        $payment->p_code_vnpay = $vnp_TransactionStatus;
        $payment->p_code_bank = $vnp_BankCode;
        $payment->p_time = $vnp_PayDate;
        $payment->save();

        if ($vnp_ResponseCode === '00' && $vnp_TransactionStatus === '00' && $request->has('vnp_SecureHash')) {
            $booking = BookRoom::with('hotel')->find($payment->p_transaction_id);
            
            $originalPrice = $booking->hotel->h_price * $booking->rooms * $booking->nights;
            $discountedPrice = $originalPrice;
            
            if ($booking->hotel->h_sale > 0) {
                $discountedPrice = $originalPrice - ($originalPrice * $booking->hotel->h_sale / 100);
            }
            
            $priceData = [
                'originalPrice' => $originalPrice,
                'discountedPrice' => $discountedPrice,
                'discountPercent' => $booking->hotel->h_sale,
                'payment' => $payment // Add payment information here
            ];
            
            Log::info('Sending BookingConfirmation email with payment data:', ['payment' => $payment->toArray()]);

            try {
                Mail::to($booking->email)->send(new BookingConfirmation($booking, $priceData));
            } catch (\Exception $e) {
                Log::error('Không thể gửi email: ' . $e->getMessage());
            }

            return redirect()->route('page.home')->with('success', 'Thanh toán thành công!');
        }

        return redirect()->route('get.from.payment.hotel', $payment->p_transaction_id)
            ->with('error', 'Thông tin thanh toán chưa xác minh, vui lòng kiểm tra lại!');
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

    public function bookingForm($id) 
    {
        $hotel = Hotel::findOrFail($id);
        return view('page.hotel.booking', compact('hotel'));
    }

    public function processBooking(Request $request, $id)
    {
        $hotel = Hotel::findOrFail($id);
        
        if (!Auth::guard('users')->check() && !Auth::guard('web')->check()) {
            return redirect()->back()->with('error', 'Vui lòng đăng nhập để đặt phòng');
        }

        try {
            $userId = Auth::guard('users')->check() ? Auth::guard('users')->id() : Auth::guard('web')->id();
            $user = Auth::guard('users')->check() ? Auth::guard('users')->user() : Auth::guard('web')->user();
            
            // Add validation for dates
            $checkinDate = new \DateTime($request->checkin_date);
            $checkoutDate = new \DateTime($request->checkout_date);
            $today = new \DateTime();
            
            if ($checkinDate < $today) {
                return redirect()->back()->with('error', 'Ngày nhận phòng không thể là ngày trong quá khứ');
            }

            if ($checkoutDate <= $checkinDate) {
                return redirect()->back()->with('error', 'Ngày trả phòng phải sau ngày nhận phòng');
            }

            $interval = $checkinDate->diff($checkoutDate);
            $nightsDiff = $interval->days;

            if ($nightsDiff != $request->nights) {
                return redirect()->back()->with('error', 'Số đêm không khớp với khoảng thời gian đã chọn');
            }

            // Rest of validation
            $data = $request->validate([
                'name'         => 'required|string|max:255',
                'phone'        => 'required|string|max:15',
                'address'      => 'required|string|max:255',
                'checkin_date' => 'required|date',
                'checkout_date'=> 'required|date|after:checkin_date',
                'nights'       => 'required|integer|min:1',
                'rooms'        => 'required|integer|min:1',
                'guests'       => 'required|integer|min:1',
                'email'        => 'required|email',
                'note'         => 'nullable|string|max:500',
                'agreePolicy'  => 'required',
                'coupon'       => 'nullable|string'
            ]);

            $totalPrice = $hotel->h_price * $data['nights'] * $data['rooms'];
            if ($hotel->h_sale > 0) {
                $totalPrice = $totalPrice - ($totalPrice * $hotel->h_sale / 100);
            }

            // Add the coupon field to the booking data:
            $data['hotel_id']   = $hotel->id;
            $data['user_id']    = $userId;
            $data['total_price']= $totalPrice;
            $data['status']     = 0;
            // Ensure coupon is stored even if null
            $data['coupon']     = $request->coupon;

            $booking = BookRoom::create($data);
            
            // Send booking confirmation email
            try {
                Mail::to($booking->email)
                    ->send(new HotelBookingConfirmation(
                        $booking,
                        $hotel,
                        $user,
                        $totalPrice
                    ));
                Log::info('Confirmation email sent to: ' . $booking->email);
            } catch (\Exception $e) {
                Log::error('Failed to send confirmation email: ' . $e->getMessage());
            }

            return redirect()->back()->with('success', 'Đặt phòng thành công! Vui lòng kiểm tra email để xem chi tiết.');
        } catch (\Exception $e) {
            Log::error('Booking failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại!')->withInput();
        }
    }

    // Thêm phương thức createMomoHotelPayment nếu chưa có
    public function createMomoHotelPayment(Request $request)
    {
        try {
            $bookingId = session('booking_id');
            $booking = BookRoom::with('hotel')->find($bookingId);
            if (!$booking) {
                Log::error('Hotel booking not found', ['booking_id' => $bookingId]);
                return redirect()->back()->with('error', 'Không tìm thấy thông tin đặt phòng');
            }
            // Tính số tiền cần thanh toán
            if ($booking->hotel->h_sale > 0) {
                $priceAfterDiscount = $booking->hotel->h_price - ($booking->hotel->h_price * $booking->hotel->h_sale / 100);
                $amount = $priceAfterDiscount * $booking->rooms * $booking->nights;
            } else {
                $amount = $booking->total_price;
            }
            $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
            $partnerCode = 'MOMOBKUN20180529';
            $accessKey   = 'klm05TvNBzhg7h7j';
            $secretKey   = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
            $orderInfo   = "Thanh toán đặt phòng khách sạn #" . $bookingId;
            $orderId     = $bookingId . "_" . time();
            $redirectUrl = route('payment.momo.hotel.callback'); // Thay đổi route này
            $ipnUrl      = route('payment.momo.hotel.callback'); // Và cả route này
            $extraData   = "";
            $requestId   = time() . "";
            $requestType = "payWithATM";
    
            $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
            $signature = hash_hmac("sha256", $rawHash, $secretKey);
    
            $data = [
                'partnerCode' => $partnerCode,
                'partnerName' => "Test",
                "storeId"     => "MomoTestStore",
                'requestId'   => $requestId,
                'amount'      => $amount,
                'orderId'     => $orderId,
                'orderInfo'   => $orderInfo,
                'redirectUrl' => $redirectUrl,
                'ipnUrl'      => $ipnUrl,
                'lang'        => 'vi',
                'extraData'   => $extraData,
                'requestType' => $requestType,
                'signature'   => $signature
            ];
    
            $result = $this->execPostRequest($endpoint, json_encode($data));
            $jsonResult = json_decode($result, true);
    
            if (isset($jsonResult['payUrl'])) {
                Log::info('MOMO Payment processing for hotel booking', [
                    'booking_id' => $bookingId,
                    'email'      => $booking->email
                ]);
                // Bạn có thể tạo record Payment tại đây nếu cần
                return redirect()->to($jsonResult['payUrl']);
            }
    
            Log::error('MOMO Payment failed', ['response' => $jsonResult]);
            return redirect()->back()->with('error', 'Không thể kết nối tới MOMO');
    
        } catch (\Exception $e) {
            Log::error('MOMO Payment error', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Đã xảy ra lỗi trong quá trình thanh toán');
        }
    }

    public function processPayment(Request $request, $id)
    {
        $booking = BookRoom::with('hotel')->find($id);
        if (!$booking) {
            return redirect()->back()->with('error', 'Không tìm thấy đơn đặt phòng');
        }

        $paymentType = $request->input('payment_type');

        switch ($paymentType) {
            case 'MOMO':
                return $this->createMomoHotelPayment($request);
            case 'VNPAY':
                return $this->createPayMent($request);
            default:
                return redirect()->back()->with('error', 'Phương thức thanh toán không hợp lệ');
        }
    }

    public function momoHotelCallback(Request $request) 
    {
        Log::info('MOMO callback received:', $request->all());
        
        if ($request->resultCode == '0' || $request->resultCode == 0) {
            try {
                $orderId = explode('_', $request->orderId)[0];
                $booking = BookRoom::with('hotel')->find($orderId);
                
                if ($booking) {
                    $booking->status = 1;
                    $booking->save();
                    
                    $payment = \App\Models\Payment::create([
                        'p_transaction_id' => $booking->id,
                        'p_user_id' => $booking->user_id,
                        'p_money' => $request->amount,
                        'p_transaction_code' => $request->orderId,
                        'p_code_momo' => $request->transId,
                        'p_code_bank' => 'MOMO',
                        'p_bank_name' => 'Ví điện tử MOMO', // Added this line
                        'p_time' => date('Y-m-d H:i:s'),
                        'p_note' => 'Thanh toán MOMO Hotel #' . $booking->id,
                        'book_room_id' => $booking->id
                    ]);
                    
                    // Send MOMO success email
                    try {
                        Mail::to($booking->email)->send(new MomoPaymentHotel($booking, $payment));
                    } catch (\Exception $e) {
                        Log::error('Failed to send MOMO success email: ' . $e->getMessage());
                    }
                    
                    return redirect()->route('page.home')->with('success', 'Thanh toán thành công! Cảm ơn bạn đã đặt phòng.');
                }
            } catch (\Exception $e) {
                Log::error('MOMO callback processing error: ' . $e->getMessage());
            }
        }
        
        return redirect()->route('page.home')->with('error', 'Đã xảy ra lỗi trong quá trình thanh toán. Vui lòng liên hệ với chúng tôi để được hỗ trợ.');
    }

    // VNPAY callback for hotel bookings
    public function vnpayHotelCallback(Request $request)
    {
        Log::info('VNPAY callback received:', $request->all());
        
        if ($request->get('vnp_ResponseCode') === '00' && $request->get('vnp_TransactionStatus') === '00') {
            try {
                $txnRef = $request->get('vnp_TxnRef');
                $orderId = explode('_', $txnRef)[0];
                $booking = \App\Models\BookRoom::with('hotel')->find($orderId);
                
                if ($booking) {
                    // Check if payment already exists
                    $existingPayment = \App\Models\Payment::where('p_transaction_code', $txnRef)->first();
                    if ($existingPayment) {
                        return redirect()->route('page.home')->with('error', 'Giao dịch đã được xử lý trước đó.');
                    }

                    $booking->status = 1;
                    $booking->save();
                    
                    // Create single payment record here
                    $payment = \App\Models\Payment::create([
                        'p_transaction_id'   => $booking->id,
                        'p_user_id'          => $booking->user_id,
                        'p_money'            => $request->get('vnp_Amount') / 100,
                        'p_transaction_code' => $txnRef,
                        'p_code_bank'        => $request->get('vnp_BankCode'),
                        'p_code_vnpay'       => $request->get('vnp_TransactionNo'),
                        'p_bank_name'        => $this->getBankName($request->get('vnp_BankCode')),
                        'p_time'             => date('Y-m-d H:i:s', strtotime($request->get('vnp_PayDate'))),
                        'p_note'             => 'Thanh toán VNPay Hotel #' . $booking->id,
                        'book_room_id'       => $booking->id,
                        'p_vnp_response_code' => $request->get('vnp_ResponseCode')
                    ]);
                    
                    // Calculate price data
                    $originalPrice = $booking->hotel->h_price * $booking->rooms * $booking->nights;
                    $discountedPrice = $originalPrice;
                    if ($booking->hotel->h_sale > 0) {
                        $discountedPrice = $originalPrice - ($originalPrice * $booking->hotel->h_sale / 100);
                    }
                    
                    $priceData = [
                        'originalPrice'   => $originalPrice,
                        'discountedPrice' => $discountedPrice,
                        'discountPercent' => $booking->hotel->h_sale,
                        'payment'         => $payment
                    ];
                    
                    try {
                        Mail::to($booking->email)->send(new BookingConfirmation($booking, $priceData));
                    } catch (\Exception $e) {
                        Log::error('Failed to send VNPAY confirmation email: ' . $e->getMessage());
                    }
                    
                    return redirect()->route('page.home')->with('success', 'Thanh toán VNPAY thành công!');
                }
            } catch (\Exception $e) {
                Log::error('VNPAY callback processing error: ' . $e->getMessage());
            }
        }
        
        return redirect()->route('page.home')->with('error', 'Thông tin thanh toán chưa xác minh, vui lòng kiểm tra lại!');
    }

    // Add this helper method at the end of the class
    private function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data)
        ]);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    // Add helper method to get bank name
    private function getBankName($bankCode)
    {
        $banks = [
            'NCB' => 'Ngân hàng NCB',
            'VIETCOMBANK' => 'Ngân hàng Vietcombank',
            'VIETINBANK' => 'Ngân hàng VietinBank',
            'BIDV' => 'Ngân hàng BIDV',
            'AGRIBANK' => 'Ngân hàng Agribank',
            'SACOMBANK' => 'Ngân hàng SacomBank',
            'TECHCOMBANK' => 'Ngân hàng Techcombank',
            'MBBANK' => 'Ngân hàng MBBank',
            'ACB' => 'Ngân hàng ACB',
            'VPB' => 'Ngân hàng VPBank',
            'TPB' => 'Ngân hàng TPBank',
            // Add more banks as needed
        ];
        
        return $banks[$bankCode] ?? $bankCode;
    }
}
