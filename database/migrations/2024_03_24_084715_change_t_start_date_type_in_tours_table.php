
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTStartDateTypeInToursTable extends Migration
{
    public function up()
    {
        Schema::table('tours', function (Blueprint $table) {
            $table->text('t_start_date')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('tours', function (Blueprint $table) {
            $table->date('t_start_date')->nullable()->change();
        });
    }
}
