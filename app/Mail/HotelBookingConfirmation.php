<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class HotelBookingConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $hotel;
    public $user;
    public $totalPrice;

    public function __construct($booking, $hotel, $user, $totalPrice)
    {
        $this->booking = $booking;
        $this->hotel = $hotel;
        $this->user = $user;
        $this->totalPrice = $totalPrice;

        // Log the data being passed to the email
        Log::info('Email Data:', [
            'booking_id' => $booking->id,
            'hotel_name' => $hotel->h_name,
            'user_email' => $booking->email,
            'total_price' => $totalPrice
        ]);
    }

    public function build()
    {
        try {
            return $this->subject('Xác nhận đặt phòng khách sạn thành công')
                        ->view('emails.hotel-booking-confirmation')
                        ->with([
                            'booking' => $this->booking,
                            'hotel' => $this->hotel,
                            'user' => $this->user,
                            'totalPrice' => $this->totalPrice,
                            'bookRoom' => $this->booking // Add this for template compatibility
                        ]);
        } catch (\Exception $e) {
            Log::error('Error building email: ' . $e->getMessage());
            throw $e;
        }
    }
}
