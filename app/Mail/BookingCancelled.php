<?php

namespace App\Mail;

use App\Models\BookRoom;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class BookingCancelled extends Mailable
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
            return $this->subject('Thông báo hủy đặt phòng')
                    ->view('emails.booking_cancelled')
                    ->with([
                        'bookRoom' => $this->bookRoom,
                        'booking' => $this->bookRoom,
                        'hotel' => $this->bookRoom->hotel,
                    ]);
        } catch (\Exception $e) {
            Log::error('Error building cancellation email: ' . $e->getMessage());
            throw $e;
        }
    }
}
