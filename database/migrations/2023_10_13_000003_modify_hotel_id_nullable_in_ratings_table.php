<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyHotelIdNullableInRatingsTable extends Migration
{
    public function up()
    {
        Schema::table('ratings', function (Blueprint $table) {
            $table->unsignedBigInteger('hotel_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('ratings', function (Blueprint $table) {
            $table->unsignedBigInteger('hotel_id')->nullable(false)->change();
        });
    }
}
