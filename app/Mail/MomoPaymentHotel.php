<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MomoPaymentHotel extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $payment;
    public $priceData;

    public function __construct($booking, $payment)
    {
        $this->booking = $booking;
        $this->payment = $payment;
        
        // Calculate price data
        $originalPrice = $booking->hotel->h_price * $booking->rooms * $booking->nights;
        $discountedPrice = $originalPrice;
        
        if ($booking->hotel->h_sale > 0) {
            $discountedPrice = $originalPrice - ($originalPrice * $booking->hotel->h_sale / 100);
        }
        
        $this->priceData = [
            'originalPrice' => $originalPrice,
            'discountedPrice' => $discountedPrice,
            'discountPercent' => $booking->hotel->h_sale
        ];
    }

    public function build()
    {
        return $this->subject('Xác nhận thanh toán MOMO cho đặt phòng khách sạn thành công')
                    ->view('emails.momo-payment-hotel');
    }
}
