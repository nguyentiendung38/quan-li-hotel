<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterHotelsHroomsColumn extends Migration
{
    public function up()
    {
        Schema::table('hotels', function (Blueprint $table) {
            // Chuyển đổi cột h_rooms từ integer sang string
            $table->string('h_rooms')->change();
        });
    }

    public function down()
    {
        Schema::table('hotels', function (Blueprint $table) {
            // Nếu cần, revert về integer
            $table->integer('h_rooms')->change();
        });
    }
}
