<?php

namespace App\Mail;

use App\Models\BookRoom;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

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
        try {
            return $this->subject('Xác nhận thanh toán đặt phòng')
                    ->view('emails.booking_paid')
                    ->with([
                        'bookRoom' => $this->bookRoom,
                        'booking' => $this->bookRoom,
                        'hotel' => $this->bookRoom->hotel,
                    ]);
        } catch (\Exception $e) {
            Log::error('Error building payment confirmation email: ' . $e->getMessage());
            throw $e;
        }
    }
}
