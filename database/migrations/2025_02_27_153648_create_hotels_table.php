<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelsTable extends Migration
{
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('h_name');
            $table->foreignId('h_location_id')->constrained('locations');
            $table->tinyInteger('h_status')->default(1);
            $table->decimal('h_price', 10, 2);
            $table->string('h_phone');
            $table->string('h_address');
            $table->text('h_description')->nullable();
            $table->text('h_content')->nullable();
            $table->string('h_image')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hotels');
    }
}
