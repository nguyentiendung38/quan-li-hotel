<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class MomoPaymentSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $emailData;

    public function __construct($emailData)
    {
        $this->emailData = $emailData;
        Log::info('Email data received:', $emailData); // Add logging
    }

    public function build()
    {
        try {
            Log::info('Building email with data:', $this->emailData);
            
            return $this->subject('Xác nhận thanh toán tour thành công qua MOMO')
                        ->view('emails.momo-payment-tour')
                        ->with([
                            'payment' => $this->emailData['payment'],
                            'booking' => $this->emailData['booking'],
                            'tour' => $this->emailData['tour']
                        ]);
        } catch (\Exception $e) {
            Log::error('Email build error: ' . $e->getMessage());
            throw $e;
        }
    }
}
