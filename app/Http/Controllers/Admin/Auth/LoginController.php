<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        // $this->middleware('guest')->except('logout');
        $this->user = $user;
    }

    public function login()
    {
        if (\Auth::check()) {
            return redirect()->back();
        }

        return view('admin.auth.login');
    }

    /**
     * Xử lý thực hiện đăng nhập trang admin
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postLogin(LoginRequest $request)
    {
        $data = $request->except('_token');
        $user = $this->user->getInfoEmail($data['email']);
        
        if (!$user) {
            // Trả về trang cũ với session danger
            return redirect()->back()
                ->with('danger', 'Sorry, looks like there are some errors detected, please try again.');
        }
    
        if (Auth::attempt($data)) {
            // Đăng nhập thành công -> Hiển thị popup success
            return view('admin.auth.login')->with('showSuccess', true);
        }
    
        // Đăng nhập sai password -> session danger
        return redirect()->back()
            ->with('danger', 'Sorry, looks like there are some errors detected, please try again.');
    }
    
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
