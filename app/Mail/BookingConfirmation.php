<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $priceData;

    public function __construct($booking, $priceData)
    {
        $this->booking = $booking;
        $this->priceData = $priceData;
        // The payment information will be available in $priceData['payment']
    }

    public function build()
    {
        return $this->subject('Xác nhận thanh toán VNPAY cho đặt phòng khách sạn thành công
')
                    ->view('emails.booking-confirmation');
    }
}
