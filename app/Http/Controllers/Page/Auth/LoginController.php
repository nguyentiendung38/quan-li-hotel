<?php

namespace App\Http\Controllers\Page\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $user;

    public function __construct(User $user)
    {
        // Nếu bạn muốn middleware guest cho các route khác, mở dòng dưới
        // $this->middleware('guest')->except('logout');
        $this->user = $user;
    }

    public function login()
    {
        if (Auth::guard('users')->check()) {
            return redirect()->back();
        }
        return view('page.auth.login');
    }

    public function postLogin(LoginRequest $request)
    {
        $data = $request->except('_token');
        $user = $this->user->getInfoEmail($data['email']);

        if (!$user) {
            $message = 'Email không tồn tại.';
            if ($request->ajax()) {
                return response()->json(['message' => $message], 422);
            }
            return redirect()->back()
                ->with('error', $message) // changed key from 'danger' to 'success'
                ->withInput($request->except('password'));
        }

        if (Auth::guard('users')->attempt($data)) {
            if ($request->ajax()) {
                return response()->json(['message' => 'Đăng nhập thành công.']);
            }
            return redirect()->route('page.home')
                ->with('success', 'Bạn đã đăng nhập thành công !');
        }

        $message = 'Mật khẩu không chính xác.';
        if ($request->ajax()) {
            return response()->json(['message' => $message], 422);
        }
        return redirect()->back()
            ->with('error', $message) // changed key from 'danger' to 'success'
            ->withInput($request->except('password'));
    }

    public function logout()
    {
        Auth::guard('users')->logout();
        return redirect()->route('page.home');
    }
}
