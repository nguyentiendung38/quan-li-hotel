<?php

namespace App\Http\Controllers\Page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\User;
use App\Models\BookTour;
use App\Http\Requests\BookTourRequest;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log; // Add this import
use App\Models\Payment;
use App\Mail\AdminBookingMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\MomoPaymentSuccessMail; // Thêm use statement này ở đầu file
use Illuminate\Support\Facades\File; // Add this import for file handling

class TourController extends Controller
{
    public function index(Request $request)
    {
        $tours = Tour::with('user');

        if ($request->key_tour) {
            $tours->where('t_title', 'like', '%' . $request->key_tour . '%');
        }

        if ($request->filled('t_start_date')) {
            try {
                $searchDate = Carbon::createFromFormat('d/m/Y', $request->t_start_date)->format('Y-m-d');
                Log::info('Searching date: ' . $searchDate);

                $tours->where(function ($query) use ($searchDate) {
                    $query->whereRaw("JSON_CONTAINS(t_start_date, '\"$searchDate\"')");
                });
            } catch (\Exception $e) {
                Log::error('Date parsing error: ' . $e->getMessage());
            }
        }

        if ($request->price) {
            $price = explode('-', $request->price);
            $tours->whereBetween('t_price_adults', [$price[0], $price[1]]);
        }

        $tours = $tours->orderBy('id', 'DESC')->paginate(NUMBER_PAGINATION_PAGE);

        return view('page.tour.index', compact('tours'));
    }

    public function detail(Request $request, $id)
    {
        $tour = Tour::with([
            'comments' => function ($query) use ($id) {
                $query->with([
                    'user',
                    'replies' => function ($q) {
                        $q->with('user')->limit(10);
                    }
                ])
                    ->where('cm_tour_id', $id)
                    ->where('cm_status', '1')
                    ->limit(20)
                    ->orderByDesc('id');
            },
            'ratings'  // Add this to load ratings
        ])->find($id);

        if (!$tour) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        // Sử dụng khóa phiên cho mỗi người dùng (hoặc mỗi khách) để mỗi người xem duy nhất chỉ tăng số lượng một lần.
        if (Auth::guard('users')->check()) {
            $userId = Auth::guard('users')->id();
            $sessionKey = 'viewed_tour_' . $tour->id . '_user_' . $userId;
        } else {
            $sessionKey = 'viewed_tour_' . $tour->id;
        }

        if (!session()->has($sessionKey)) {
            $tour->increment('t_view');
            session([$sessionKey => true]);
        }

        $tours = Tour::where('t_location_id', $tour->t_location_id)
            ->where('id', '<>', $id)
            ->orderBy('id')
            ->limit(NUMBER_PAGINATION_PAGE)
            ->get();

        return view('page.tour.detail', compact('tour', 'tours'));
    }

    public function bookTour(Request $request, $id, $slug)
    {
        if (!Auth::guard('users')->check()) {
            return redirect()->back()->with('error', 'Vui lòng đăng nhập để đặt tour');
        }
        $tour = Tour::find($id);
        if (!$tour) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }
        $user = User::find(Auth::guard('users')->user()->id);
        return view('page.tour.book', compact('tour', 'user'));
    }

    public function postBookTour(BookTourRequest $request, $id)
    {
        $tour = Tour::find($id);
        if (!$tour) {
            return redirect()->back()->with('error', 'Tour không tồn tại');
        }

        // Tính tổng số người đặt
        $numberUser = $request->b_number_adults
            + $request->b_number_children
            + $request->b_number_child6
            + $request->b_number_child2;

        if (($tour->t_number_registered + $numberUser) > $tour->t_number_guests) {
            return redirect()->back()->with('error', 'Số lượng người đăng ký đã vượt quá giới hạn');
        }

        DB::beginTransaction();
        try {
            $params = $request->except(['_token']);
            $user = Auth::guard('users')->user();
            $params['b_tour_id'] = $id;
            $params['b_user_id'] = $user->id;
            $params['b_status'] = 1;

            // Thêm ngày khởi hành vào params
            $params['departure_date'] = $request->departure_date;

            // Tính giá trên 1 người cho từng đối tượng
            $params['b_price_adults']   = $tour->t_price_adults - ($tour->t_price_adults * $tour->t_sale / 100);
            $params['b_price_children'] = $tour->t_price_children - ($tour->t_price_children * $tour->t_sale / 100);
            $params['b_price_child6']   = $params['b_price_children'] * 50 / 100;
            $params['b_price_child2']   = $params['b_price_children'] * 25 / 100;

            // Tính tổng tiền (nhân với số lượng người tương ứng)
            $priceAdults   = $params['b_price_adults']   * $params['b_number_adults'];
            $priceChildren = $params['b_price_children'] * $params['b_number_children'];
            $priceChild6   = $params['b_price_child6']   * $params['b_number_child6'];
            $priceChild2   = $params['b_price_child2']   * $params['b_number_child2'];
            $params['b_total_money'] = $priceAdults + $priceChildren + $priceChild6 + $priceChild2;

            // Lưu record đặt tour
            $book = BookTour::create($params);
            if ($book) {
                // Cập nhật số lượng người đã đăng ký của tour
                $tour->t_follow += $numberUser;
                $tour->save();

                // Gửi email
                $mailuser = $user->email;
                Mail::send('emailtiepnhan', [
                    'user' => $user,
                    'book' => $book,
                    'tour' => $tour
                ], function ($message) use ($mailuser) {
                    $message->to($mailuser)
                        ->subject('Tiếp nhận đặt tour');
                });
            }

            DB::commit();

            // Nếu là nút "Đặt Tour"
            if ($request->submit === 'book_tour') {
                session()->flash('success', 'Đặt tour thành công ! ');
                return redirect()->route('page.home');
            }

            // Nếu là nút "Thanh toán online"
            return redirect()->route('get.from.payment', $book->id);
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('Error booking tour: ' . $exception->getMessage());
            return redirect()->back()
                ->with('error', 'Đã xảy ra lỗi khi lưu dữ liệu')
                ->withInput();
        }
    }

    // Trang hiển thị form điền thông tin thanh toán VNPay
    public function getFromPayMent($id)
    {
        $book = BookTour::find($id);
        if (!$book) {
            return redirect()->back()->with('danger', 'Không thể thanh toán, đơn hàng không tồn tại.');
        }

        $totalMoney = $book->b_total_money;
        session(['book_id' => $book->id]);

        return view('page.vnpay.index', compact('book', 'totalMoney'));
    }

    // Trang hiển thị form thanh toán Onepay (nếu có)
    public function getFromOnepay($id)
    {
        $book = BookTour::find($id);
        if (!$book) {
            return redirect()->back()->with('danger', 'Đã xảy ra lỗi, không thể thanh toán online');
        }
        $totalMoney = $book->b_total_money;
        session(['book_id' => $book->id]);
        return view('page.onepay.index', compact('book', 'totalMoney'));
    }

    /**
     * =====================
     *  HÀM TẠO THANH TOÁN VNPay
     * =====================
     */
    public function createPayMent(Request $request)
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('vnpay.return'); // URL trả về, nhớ cấu hình route
        $vnp_TmnCode = "KZYZ0PPO";
        $vnp_HashSecret = "47SKX7IX1UAFALKDUYV9XQ06MA8AKKF6";

        // 1. Lấy thông tin booking hoặc đơn hàng
        //    Ví dụ bạn lưu book_id ở session hoặc request
        $bookId = session('book_id');
        $book = BookTour::find($bookId);
        if (!$book) {
            return redirect()->back()->with('error', 'Không tìm thấy đơn đặt tour.');
        }

        // 2. Sinh mã giao dịch duy nhất (vnp_TxnRef)
        //    có thể dùng time(), uniqid() hoặc kết hợp book_id
        $vnp_TxnRef = $book->id . '_' . time();

        // 3. Tạo 1 bản ghi Payment để lưu thông tin ban đầu
        //    (hoặc update nếu đã có)
        $payment = Payment::create([
            'p_transaction_id' => $book->id,        // Tham chiếu đến book_tours
            'p_user_id'        => Auth::id(),       // ID người dùng (nếu có)
            'p_money'        => $book->b_total_money, // Số tiền, tùy logic
            'p_transaction_code' => $vnp_TxnRef,  // Mã giao dịch của bạn
            'p_note'         => 'Thanh toán Vnpay cho booking Tour #' . $book->id,
            // Các trường còn lại như vnp_response_code, p_code_vnpay
            // sẽ cập nhật sau khi nhận callback từ VNPay
        ]);

        // 4. Các tham số gửi sang VNPay
        $vnp_OrderInfo = 'Thanh toán booking #' . $book->id;
        $vnp_OrderType = 'billpayment';
        // Lưu ý: VNPay cần số tiền * 100 (nếu b_total_money là đơn vị VNĐ)
        $vnp_Amount = $book->b_total_money * 100;
        $vnp_Locale = 'vn';
        // Để hiển thị danh sách ngân hàng, bạn có thể để trống
        $vnp_BankCode = '';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        // Tạo mảng inputData
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

        // Sắp xếp mảng theo key để tạo chuỗi hash
        ksort($inputData);
        $query = "";
        $hashdata = "";
        $i = 0;
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if ($vnp_HashSecret) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        // 5. Chuyển hướng sang VNPay
        if ($request->has('redirect')) {
            return redirect($vnp_Url);
        } else {
            // hoặc trả về JSON
            return response()->json([
                'code' => '00',
                'message' => 'success',
                'data' => $vnp_Url
            ]);
        }
    }

    public function vnPayReturn(Request $request)
    {
        DB::transaction(function () use ($request) {
            $vnp_TxnRef = $request->get('vnp_TxnRef');
            $vnp_ResponseCode = $request->get('vnp_ResponseCode');
            $vnp_TransactionStatus = $request->get('vnp_TransactionStatus');

            $payment = Payment::where('p_transaction_code', $vnp_TxnRef)->first();
            if (!$payment) {
                return redirect()->route('page.home')->with('error', 'Không tìm thấy giao dịch để cập nhật.');
            }

            // Cập nhật thông tin payment
            $payment->p_vnp_response_code = $vnp_ResponseCode;
            $payment->p_code_vnpay = $request->get('vnp_TransactionNo');
            $payment->p_code_bank = $request->get('vnp_BankCode');
            $payment->p_bank_name = $this->getBankName($request->get('vnp_BankCode'));
            $payment->p_time = date('Y-m-d H:i:s', strtotime($request->get('vnp_PayDate')));
            $payment->save();

            if ($vnp_ResponseCode == '00' && $vnp_TransactionStatus == '00') {
                $book = BookTour::find($payment->p_transaction_id);
                if ($book) {
                    $tour = Tour::find($book->b_tour_id);
                    $numberUser = $book->b_number_adults + $book->b_number_children +
                        $book->b_number_child6 + $book->b_number_child2;

                    // Cập nhật số người đã đăng ký và giảm số người trong t_follow
                    $tour->t_number_registered += $numberUser;
                    $tour->t_follow -= $numberUser;
                    $tour->save();

                    $book->b_status = 3; // Đã thanh toán
                    $book->save();

                    // Thêm phần gửi email xác nhận
                    try {
                        $user = Auth::guard('users')->user();
                        if ($user && $book->b_email) {
                            Mail::to($book->b_email)->send(new \App\Mail\PaymentSuccess($payment));
                        }
                    } catch (\Exception $e) {
                        Log::error('Failed to send VNPAY confirmation email: ' . $e->getMessage());
                    }
                }
            }
        });

        return redirect()->route('page.home')->with('success', 'Thanh toán Tour Vnpay thành công !');
    }

    public function momoTourCallback(Request $request)
    {
        Log::info('MOMO callback received:', $request->all());

        if ($request->resultCode == '0') {
            try {
                DB::transaction(function () use ($request) {
                    $orderId = explode('_', $request->orderId)[0];
                    $booking = BookTour::with(['tour', 'user'])->find($orderId);

                    if ($booking) {
                        $existingPayment = Payment::where('p_transaction_code', $request->orderId)->first();

                        if (!$existingPayment) {
                            // Create payment record
                            $payment = Payment::create([
                                'p_transaction_id' => $booking->id,
                                'p_user_id' => $booking->b_user_id,
                                'p_money' => $request->amount,
                                'p_transaction_code' => $request->orderId,
                                'p_code_bank' => 'MOMO',
                                'p_bank_name' => 'Ví điện tử MOMO',
                                'p_code_momo' => $request->transId,
                                'p_time' => date('Y-m-d H:i:s'),
                                'p_note' => 'Thanh toán MOMO thành công cho booking Tour #' . $booking->id,
                                'p_status' => 1
                            ]);

                            // Cập nhật số người đã đăng ký và giảm số người trong t_follow
                            $tour = Tour::find($booking->b_tour_id);
                            $numberUser = $booking->b_number_adults + $booking->b_number_children +
                                $booking->b_number_child6 + $booking->b_number_child2;

                            // Chuyển số lượng người từ t_follow sang t_number_registered
                            $tour->t_number_registered += $numberUser;
                            $tour->t_follow -= $numberUser;
                            $tour->save();

                            // Update booking status
                            $booking->b_status = 3; // Đã thanh toán
                            $booking->save();

                            // Send confirmation email
                            $this->sendPaymentConfirmationEmail($booking, $payment);
                        }
                    }
                });

                return redirect()->route('page.home')->with('success', 'Thanh toán Tour MOMO thành công !');
            } catch (\Exception $e) {
                Log::error('MOMO Payment Error:', [
                    'message' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                throw $e;
            }
        }
        return redirect()->route('page.home')->with('error', 'Thanh toán không thành công');
    }

    // Add helper method to get bank name
    private function getBankName($bankCode)
    {
        $banks = [
            'NCB' => 'Ngân hàng NCB',
            'VNPAY' => 'VNPAY',
            'VIETCOMBANK' => 'Ngân hàng Vietcombank',
            'VIETINBANK' => 'Ngân hàng Vietinbank',
            'BIDV' => 'Ngân hàng BIDV',
            'AGRIBANK' => 'Ngân hàng Agribank',
            'SACOMBANK' => 'Ngân hàng Sacombank',
            'TECHCOMBANK' => 'Ngân hàng Techcombank',
            // Thêm các ngân hàng khác nếu cần
        ];

        return $banks[$bankCode] ?? $bankCode;
    }

    // thanh toán bằng mmo
    public function createMomoPayment(Request $request)
    {
        try {
            $bookId = session('book_id');
            $booking = BookTour::find($bookId);
            if (!$booking) {
                Log::error('Booking not found:', ['booking_id' => $bookId]);
                return redirect()->back()->with('error', 'Không tìm thấy thông tin đặt tour');
            }

            $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
            $partnerCode = 'MOMOBKUN20180529';
            $accessKey = 'klm05TvNBzhg7h7j';
            $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
            $orderInfo = "Thanh toán tour du lịch #" . $bookId;
            $amount = $booking->b_total_money;
            $orderId = $bookId . "_" . time();
            $redirectUrl = route('payment.momo.tour.callback'); // Update route name
            $ipnUrl = route('payment.momo.tour.callback'); // Update route name

            $extraData = "";
            $requestId = time() . "";
            $requestType = "payWithATM";

            $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
            $signature = hash_hmac("sha256", $rawHash, $secretKey);

            $data = [
                'partnerCode' => $partnerCode,
                'partnerName' => "Test",
                "storeId" => "MomoTestStore",
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'redirectUrl' => $redirectUrl,
                'ipnUrl' => $ipnUrl,
                'lang' => 'vi',
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature
            ];

            $result = $this->execPostRequest($endpoint, json_encode($data));
            $jsonResult = json_decode($result, true);

            if (isset($jsonResult['payUrl'])) {
                Log::info('MOMO Payment processing for booking:', [
                    'booking_id' => $bookId,
                    'email' => $booking->b_email
                ]);

                return redirect()->to($jsonResult['payUrl']);
            }

            Log::error('MOMO Payment failed:', ['response' => $jsonResult]);
            return redirect()->back()->with('error', 'Không thể kết nối tới MOMO');
        } catch (\Exception $e) {
            Log::error('MOMO Payment error:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Đã xảy ra lỗi trong quá trình thanh toán');
        }
    }

    public function momoCallback(Request $request)
    {
        return $this->momoTourCallback($request);
    }

    private function sendPaymentConfirmationEmail($booking, $payment)
    {
        try {
            Mail::to($booking->b_email)
                ->send(new MomoPaymentSuccessMail([
                    'payment' => $payment,
                    'booking' => $booking,
                    'tour' => $booking->tour,
                    'transactionId' => $payment->p_code_momo,
                    'bankName' => 'Ví điện tử MOMO',
                    'paymentCode' => $payment->p_transaction_code,
                    'amount' => number_format($payment->p_money, 0, ',', '.'),
                    'payTime' => date('d/m/Y H:i:s')
                ]));
            Log::info('Payment confirmation email sent successfully');
        } catch (\Exception $e) {
            Log::error('Failed to send payment confirmation email: ' . $e->getMessage());
        }
    }

    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data)
        ]);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        $result = curl_exec($ch); //execute post
        curl_close($ch); //close connection
        return $result;
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
                'cm_hotel_id' => null,
                'cm_tour_id' => $id
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

                // Move uploaded file
                $image->move($uploadPath, $imageName);
                $commentData['cm_image'] = 'uploads/comments/' . $imageName;
            }

            $tour = Tour::findOrFail($id);
            $comment = $tour->comments()->create($commentData);

            return back()->with('success', 'Bình luận của bạn đã được gửi thành công!');
        } catch (\Exception $e) {
            \Log::error('Comment Error: ' . $e->getMessage());
            return back()->with('error', 'Có lỗi xảy ra khi gửi bình luận.');
        }
    }

    public function rate(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $tour = Tour::findOrFail($id);
        $userId = Auth::guard('users')->id();

        // Update or create the user's rating for this tour, setting hotel_id to null
        $tour->ratings()->updateOrCreate(
            ['user_id' => $userId],
            ['rating' => $request->rating, 'hotel_id' => null]
        );

        return back()->with('success', 'Cảm ơn bạn đã đánh giá tour!');
    }
    public function booking(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'tour_id' => 'required',  // Thêm validation cho tour_id
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string',
            'people' => 'required|integer|min:1',
            'date' => 'required|string',
            'pickup' => 'required|string',
            'note' => 'nullable|string',
        ]);

        // Lấy thông tin tour
        $tour = Tour::find($request->tour_id);
        if (!$tour) {
            return redirect()->back()->with('error', 'Tour không tồn tại');
        }

        // Thêm tên tour vào dữ liệu gửi mail
        $bookingData = $validated;
        $bookingData['tour_name'] = $tour->t_title; // Thêm tên tour

        // Gửi email cho admin
        Mail::to('nguyendunghk789@gmail.com')->send(new AdminBookingMail($bookingData));

        // Gửi email cho khách hàng
        Mail::to($validated['email'])->send(new \App\Mail\CustomerBookingMail($bookingData));

        return redirect()->back()->with('success', 'Đặt tour thành công.');
    }

    public function processPayment(Request $request, $id)
    {
        if ($request->get('payment_type') === 'MOMO') {
            return $this->createMomoPayment($request);
        }
        return $this->createPayMent($request);
    }
}
