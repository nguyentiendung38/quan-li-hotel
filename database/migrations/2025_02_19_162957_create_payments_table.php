<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('p_transaction_id')->nullable();
            $table->integer('p_user_id')->nullable();
            $table->float('p_money')->nullable()->comment('Số tiền thanh toán');
            $table->string('p_transaction_code', 50)->nullable()->comment('Mã giao dịch thanh toán');
            $table->string('p_note')->nullable()->comment('Ghi chú thanh toán');
            $table->string('p_vnp_response_code', 255)->nullable()->comment('Mã phản hồi');
            $table->string('p_code_vnpay', 255)->nullable()->comment('Mã giao dịch VNPay');
            $table->string('p_code_bank', 255)->nullable()->comment('Mã ngân hàng');
            $table->dateTime('p_time')->nullable()->comment('Thời gian chuyển khoản');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
