<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';

    protected $fillable = [
        'p_transaction_id',
        'p_user_id',
        'p_money',
        'p_transaction_code',
        'p_note',
        'vnp_response_code',
        'p_code_vnpay',
        'p_code_bank',
        'p_time'
    ];
}