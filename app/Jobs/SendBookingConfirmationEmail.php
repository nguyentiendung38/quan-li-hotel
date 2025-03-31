<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\BookingConfirmed;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\BookRoom;

class SendBookingConfirmationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $bookRoom;

    /**
     * Create a new job instance.
     *
     * @param BookRoom $bookRoom
     */
    public function __construct(BookRoom $bookRoom)
    {
        $this->bookRoom = $bookRoom;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            // Retrieve related data before sending email
            $bookRoom = BookRoom::with(['hotel', 'user'])->find($this->bookRoom->id);
            if ($bookRoom) {
                $mail = new BookingConfirmed($bookRoom);
                Mail::to($bookRoom->email)->send($mail);
            } else {
                Log::error('Booking not found with ID: ' . $this->bookRoom->id);
            }
        } catch (\Exception $e) {
            Log::error('Failed to send booking confirmation email to ' . $this->bookRoom->email . ': ' . $e->getMessage() . ' Trace: ' . $e->getTraceAsString());
        }
    }
}
