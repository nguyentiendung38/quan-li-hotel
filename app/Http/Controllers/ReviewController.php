<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        $user = Auth::guard('users')->user();
        if (!$user) {
            return redirect()->route('page.user.account');
        }
        $reviews = Review::where('user_id', $user->id)->get();
        
        return view('page.auth.review', compact('reviews'));
    }

    public function destroy($id)
    {
        $user = Auth::guard('users')->user();
        $review = Review::findOrFail($id);
        if ($review->user_id !== $user->id) {
            return redirect()->back()->with('error', 'Bạn không có quyền xóa đánh giá này.');
        }
        $review->delete();
        return redirect()->back()->with('success', 'Đánh giá đã được hủy.');
    }
}
