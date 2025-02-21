<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Payment;

class PaymentSuccess extends Mailable
{
    use Queueable, SerializesModels;
    
    public $payment;
    
    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }
    
    public function build()
    {
        return $this->subject('Qúy khách đã thanh toán thành công')
                    ->view('emails.payment_success');
    }
}
