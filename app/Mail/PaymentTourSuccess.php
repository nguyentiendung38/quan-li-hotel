<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentTourSuccess extends Mailable
{
    use Queueable, SerializesModels;

    public $payment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($payment)
    {
        $this->payment = $payment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Chỉ gửi email nếu payment đã thành công
        if ($this->payment->p_status == 1) {
            return $this->view('emails.vnpay-payment-tour')
                        ->subject('Xác nhận thanh toán thành công')
                        ->with([
                            'payment' => $this->payment
                        ]);
        }
        return $this;
    }
}
