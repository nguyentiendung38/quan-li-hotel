<?php

namespace App\Http\Controllers\Page\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ReCaptcha;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
    }

    public function register()
    {
        // Đã cập nhật: sử dụng Auth::check() thay vì Auth::guard('users')->check()
        if (Auth::check()) { 
            return redirect()->back();
        }

        return view('page.auth.register');
    }

    public function postRegister(RegisterRequest $request)
    {
        // Debug dữ liệu request (đã comment)
        // dd($request->all());

        // Bật kiểm tra reCAPTCHA
        $captchaResponse = $request->get('g-recaptcha-response');
        if(!$captchaResponse) {
            return redirect()->back()
                ->withErrors(['g-recaptcha-response' => 'Vui lòng xác nhận captcha'])
                ->withInput();
        }
        if(!ReCaptcha::validateCaptcha($captchaResponse)) {
            return redirect()->back()
                ->withErrors(['g-recaptcha-response' => 'Xác thực captcha không thành công'])
                ->withInput();
        }

        \DB::beginTransaction();
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->password = bcrypt($request->password);
            $user->save();

            // Debug: hiển thị id của user sau khi lưu (đã comment)
            // dd('User saved with id: ' . $user->id);

            // Đăng nhập người dùng bằng guard mặc định
            Auth::loginUsingId($user->id, true);
            \DB::commit();
            return redirect()->route('page.home')
                ->with('success', 'Bạn đã đăng ký tài khoản thành công');
        } catch (\Exception $exception) {
            \Log::error('Đăng ký không lưu: ' . $exception->getMessage());
            \DB::rollBack();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi không thể đăng ký tài khoản');
        }
    }
}
