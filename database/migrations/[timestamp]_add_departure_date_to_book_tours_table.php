<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('book_tours', function (Blueprint $table) {
            $table->string('departure_date')->nullable()->after('b_tour_id');
        });
    }

    public function down()
    {
        Schema::table('book_tours', function (Blueprint $table) {
            $table->dropColumn('departure_date');
        });
    }
};
