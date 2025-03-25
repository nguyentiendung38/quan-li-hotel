<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddServiceAndNotesToTours extends Migration
{
    public function up()
    {
        Schema::table('tours', function (Blueprint $table) {
            $table->text('t_service_included')->nullable();
            $table->text('t_notes')->nullable();
        });
    }

    public function down()
    {
        Schema::table('tours', function (Blueprint $table) {
            $table->dropColumn(['t_service_included', 't_notes']);
        });
    }
}
