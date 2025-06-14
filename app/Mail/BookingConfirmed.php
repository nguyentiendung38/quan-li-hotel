<?php

namespace App\Mail;

use App\Models\BookRoom;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    public $bookRoom;

    public function __construct(BookRoom $bookRoom)
    {
        $this->bookRoom = $bookRoom;
    }

    public function build()
    {
        return $this->subject('Đặt phòng của bạn đã được xác nhận')
                    ->view('emails.booking_confirmed')
                    ->with([
                        'bookRoom' => $this->bookRoom,
                        'booking' => $this->bookRoom,
                        'user' => $this->bookRoom->user,
                        'totalPrice' => $this->bookRoom->total_price,
                        'hotel' => $this->bookRoom->hotel
                    ]);
    }
}
