<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomerHotelBookingMail extends Mailable
{
    use Queueable, SerializesModels;

    public $bookingData;

    public function __construct($bookingData)
    {
        $this->bookingData = $bookingData;
    }

    public function build()
    {
        return $this->subject('Xác Nhận Đặt Phòng')
                    ->view('emails.customer_hotel_booking');
    }
}
