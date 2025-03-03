<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cm_hotel_id')->constrained('hotels')->onDelete('cascade');
            $table->foreignId('cm_user_id')->constrained('users')->onDelete('cascade');
            $table->text('cm_content');
            $table->tinyInteger('cm_status')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
