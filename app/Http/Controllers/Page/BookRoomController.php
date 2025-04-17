<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookRoom;
use Illuminate\Support\Facades\Auth;

class BookRoomController extends Controller
{
    public function myRooms()
    {
        $user = Auth::guard('users')->user();
        $bookRooms = BookRoom::with('hotel')
            ->where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('page.auth.my_rooms', compact('bookRooms'));
    }
}
