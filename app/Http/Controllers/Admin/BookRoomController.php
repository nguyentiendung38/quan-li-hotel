<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookRoom;
use App\Models\Hotel;

class BookRoomController extends Controller
{
    public function index(Request $request)
    {
        $bookRooms = BookRoom::orderByDesc('id')->paginate(NUMBER_PAGINATION);
        return view('admin.book_room.index', compact('bookRooms'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        \DB::beginTransaction();
        try {
            BookRoom::create($data);
            \DB::commit();
            return redirect()->route('book.room.index')->with('success', 'Lưu dữ liệu thành công');
        } catch (\Exception $exception) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi lưu dữ liệu');
        }
    }

    public function delete($id)
    {
        $bookRoom = BookRoom::find($id);
        if (!$bookRoom) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        try {
            $bookRoom->delete();
            return redirect()->back()->with('success', 'Xóa thành công');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi không thể xóa dữ liệu');
        }
    }

    public function updateStatus($status, $id)
    {
        $bookRoom = BookRoom::find($id);
        if (!$bookRoom) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        \DB::beginTransaction();
        try {
            $bookRoom->status = $status;
            $bookRoom->save();
            \DB::commit();
            return redirect()->route('book.room.index')->with('success', 'Cập nhật trạng thái thành công');
        } catch (\Exception $exception) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi cập nhật trạng thái');
        }
    }
}
