<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->text('h_album_images')->nullable()->after('h_image'); // Lưu dạng JSON
        });
    }
    
    public function down()
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropColumn('h_album_images');
        });
    }
};
