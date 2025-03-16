<?php
namespace App\Http\Controllers\Page\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str; // added import for Str
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    // replaced str_random(16) with Str::random(16)
                    'password' => bcrypt(Str::random(16)),
                    // ... add additional fields as needed ...
                ]
            );
            Auth::guard('users')->login($user);
            return redirect()->route('page.home');
        } catch (\Exception $e) {
            return redirect()->route('page.user.account')->with('error', 'Đã có lỗi xảy ra. Vui lòng thử lại.');
        }
    }
}
