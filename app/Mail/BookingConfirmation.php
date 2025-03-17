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
    }

    public function build()
    {
        return $this->subject('Xác nhận đặt phòng khách sạn')
                    ->view('emails.booking-confirmation');
    }
}
