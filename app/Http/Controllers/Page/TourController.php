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
use App\Models\Payment;
use App\Mail\AdminBookingMail;
use Illuminate\Support\Facades\Mail;

class TourController extends Controller
{
    public function index(Request $request)
    {
        $tours = Tour::with('user');

        if ($request->key_tour) {
            $tours->where('t_title', 'like', '%' . $request->key_tour . '%');
        }
        if ($request->t_start_date) {
            $startDate = date('Y-m-d', strtotime($request->t_start_date));
            $tours->where('t_start_date', '>=', $startDate);
        }
        if ($request->t_end_date) {
            $endDate = date('Y-m-d', strtotime($request->t_end_date));
            $tours->where('t_end_date', '<=', $endDate);
        }
        if ($request->price) {
            $price = explode('-', $request->price);
            $tours->whereBetween('t_price_adults', [$price[0], $price[1]]);
        }

        $tours = $tours->orderBy('t_start_date')->paginate(NUMBER_PAGINATION_PAGE);
        return view('page.tour.index', ['tours' => $tours]);
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
            }
            DB::commit();

            // Nếu người dùng chọn "Thanh toán online" thì chuyển hướng sang trang VNPay
            if ($request->submit == 'Thanh toán online') {
                return redirect()->route('get.from.payment', $book->id);
            }

            return redirect()->route('page.home')->with('success', 'Cám ơn bạn đã đặt tour, chúng tôi sẽ liên hệ sớm.');
        } catch (Exception $exception) {
            DB::rollBack();
            dd($exception->getMessage());
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi lưu dữ liệu');
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
            'p_note'         => 'Thanh toán cho booking #' . $book->id,
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
        // 1. Lấy các tham số từ URL
        $vnp_TxnRef = $request->get('vnp_TxnRef'); // Mã giao dịch của bạn
        $vnp_ResponseCode = $request->get('vnp_ResponseCode'); // Mã phản hồi VNPay
        $vnp_TransactionStatus = $request->get('vnp_TransactionStatus'); // Trạng thái giao dịch
        $vnp_BankCode = $request->get('vnp_BankCode');
        $vnp_PayDate = $request->get('vnp_PayDate'); // YYYYmmddHHiiss

        // 2. Tìm payment dựa trên p_transaction_code
        $payment = Payment::where('p_transaction_code', $vnp_TxnRef)->first();
        if (!$payment) {
            return redirect()->route('page.home')->with('error', 'Không tìm thấy giao dịch để cập nhật.');
        }

        // 3. Cập nhật các thông tin từ VNPay
        $payment->p_vnp_response_code = $vnp_ResponseCode;
        $payment->p_code_vnpay = $vnp_TransactionStatus; // hoặc vnp_TransactionNo
        $payment->p_code_bank = $vnp_BankCode;
        $payment->p_time = $vnp_PayDate; // Lưu thô, hoặc convert sang datetime
        $payment->save();

        // 4. Kiểm tra giao dịch thành công
        // - vnp_ResponseCode == '00' và vnp_TransactionStatus == '00' => thanh toán thành công
        if ($vnp_ResponseCode == '00' && $vnp_TransactionStatus == '00') {
            // Cập nhật trạng thái booking, ví dụ:
            // $book = BookTour::find($payment->transaction_id);
            // $book->b_status = 2; // 2 = đã thanh toán
            // $book->save();

            // Retrieve user's email (assuming the user is logged in)
            $user = Auth::guard('users')->user();
            if ($user && $user->email) {
                \Mail::to($user->email)->send(new \App\Mail\PaymentSuccess($payment));
            }

            return redirect()->route('page.home')->with('success', 'Thanh toán thành công!');
        } else {
            return redirect()->route('page.home')->with('error', 'Thanh toán không thành công hoặc bị hủy.');
        }
    }



    public function createOnepayPayment(Request $request)
    {
        // Xử lý thông tin thanh toán OnePay (nếu cần)
        $bookId = $request->book_id;
        $amount = $request->amount;
        dd("Onepay payment processing for book_id: $bookId, amount: $amount");
    }

    public function comment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string',
        ]);

        $tour = Tour::findOrFail($id);

        $tour->comments()->create([
            'cm_user_id'  => Auth::guard('users')->id(),   // correct user id column
            'cm_content'  => $request->comment,              // store comment text
            'cm_hotel_id' => null,                          // set hotel id to null for tour comments
            'cm_tour_id'  => $tour->id,                       // assign the tour id
        ]);

        return back()->with('success', 'Bình luận của bạn đã được gửi!');
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
}
