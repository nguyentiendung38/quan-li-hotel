<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required',
            'phone'   => 'required',
            'email'   => 'required|email',
            'partner' => 'nullable',
            'message' => 'required'
        ]);

        // Rename "message" to "contact_message" to avoid conflicts in the view.
        $data['contact_message'] = $data['message'];
        unset($data['message']);

        Mail::send('emails.contact', $data, function ($message) use ($data) {
            $message->to('emailcuaban@example.com', 'Admin')
                ->subject('Liên hệ mới từ website')
                ->replyTo($data['email'], $data['name']);
        });

        return back()->with('success', 'Chúng tôi đã nhận được thông tin của bạn!');
    }
}
