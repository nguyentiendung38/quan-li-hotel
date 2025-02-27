<?php

namespace App\Http\Controllers\Page\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function showResetForm($token)
    {
        // ...existing logic if needed...
        return view('page.auth.password_reset')->with(['token' => $token]);
    }
}
