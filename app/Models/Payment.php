<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $fillable = [
        'p_transaction_id',
        'p_user_id',
        'p_money',
        'p_transaction_code',
        'p_note',
        'p_code_vnpay',
        'p_code_bank',
        'p_code_momo',
        'p_bank_name',
        'p_time',
        'p_status',
        'p_vnp_response_code'
    ];

    public function getBankNameAttribute()
    {
        return $this->p_bank_name ?? 'Ví điện tử MOMO';
    }

    public function getMomoCodeAttribute()
    {
        return $this->p_code_momo ?: null;
    }

    // Add accessor to help debug
    public function getMomoTransactionAttribute() 
    {
        return [
            'p_code_momo' => $this->p_code_momo,
            'p_code_bank' => $this->p_code_bank,
            'raw_data' => $this->toArray()
        ];
    }

    public function bookRoom()
    {
        return $this->belongsTo(BookRoom::class);
    }

    public function bookTour()
    {
        return $this->belongsTo(BookTour::class, 'book_tour_id');
    }
}