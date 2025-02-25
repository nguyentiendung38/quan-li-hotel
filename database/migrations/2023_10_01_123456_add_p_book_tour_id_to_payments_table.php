<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPBookTourIdToPaymentsTable extends Migration
{
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            // Thêm cột p_book_tour_id, kiểu unsignedBigInteger, tùy chỉnh theo yêu cầu (nullable hoặc không)
            $table->unsignedBigInteger('p_book_tour_id')->nullable();
        });
    }

    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('p_book_tour_id');
        });
    }
}
