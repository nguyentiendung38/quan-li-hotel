<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMomoTransactionCodes extends Migration
{
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            if (!Schema::hasColumn('payments', 'p_code_momo')) {
                $table->string('p_code_momo')->nullable()->after('p_code_bank');
            }
        });

        // Không copy p_transaction_code nữa
        // Để trống p_code_momo cho các giao dịch cũ
    }

    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('p_code_momo');
        });
    }
}
