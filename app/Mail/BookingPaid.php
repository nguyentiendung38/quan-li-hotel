<?php

namespace App\Mail;

use App\Models\BookRoom;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingPaid extends Mailable
{
    use Queueable, SerializesModels;

    public $bookRoom;

    public function __construct(BookRoom $bookRoom)
    {
        $this->bookRoom = $bookRoom;
    }

    public function build()
    {
        return $this->subject('Đặt phòng của bạn đã được thanh toán')
                    ->view('emails.booking_paid')
                    ->with(['bookRoom' => $this->bookRoom]);
    }
}
