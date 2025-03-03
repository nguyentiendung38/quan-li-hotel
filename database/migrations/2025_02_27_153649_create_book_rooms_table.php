<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookRoomsTable extends Migration
{
    public function up()
    {
        Schema::create('book_rooms', function (Blueprint $table) {
            $table->id(); // Tạo trường 'id' là khóa chính
            $table->foreignId('hotel_id')->constrained('hotels'); // Tạo khóa ngoại liên kết với bảng 'hotels'
            $table->foreignId('user_id')->constrained('users'); // Tạo khóa ngoại liên kết với bảng 'users'
            $table->date('checkin_date'); // Ngày nhận phòng
            $table->date('checkout_date'); // Ngày trả phòng
            $table->integer('nights'); // Số đêm
            $table->integer('rooms'); // Số phòng
            $table->integer('guests'); // Số khách
            $table->decimal('total_price', 10, 2); // Tổng giá (sử dụng decimal để chứa số với 2 chữ số sau dấu phẩy)
            $table->tinyInteger('status')->default(0); // Trạng thái đặt phòng, mặc định là 0 (chưa xử lý)
            $table->text('note')->nullable(); // Ghi chú, có thể để trống
            $table->timestamps(); // Thêm thời gian tạo và cập nhật
        });
    }

    public function down()
    {
        Schema::dropIfExists('book_rooms'); // Hủy bảng 'book_rooms' khi rollback migration
    }
}
