<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCodesToBookRoomsTable extends Migration
{
    public function up()
    {
        Schema::table('book_rooms', function (Blueprint $table) {
            $table->string('room_code')->nullable()->after('coupon');
            $table->string('booking_code')->nullable()->after('room_code');
        });
    }

    public function down()
    {
        Schema::table('book_rooms', function (Blueprint $table) {
            $table->dropColumn(['room_code', 'booking_code']);
        });
    }
}
