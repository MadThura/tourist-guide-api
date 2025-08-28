<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Check if user sent a message within the last 5 minutes
        $lastMessage = ContactMessage::where('email', $request->email)
            ->latest()
            ->first();

        if ($lastMessage && $lastMessage->created_at->diffInMinutes(now()) < 5) {
            return redirect('/#contact')->with('fail', 'Please wait 5 minutes before sending another message.');
        }

        ContactMessage::create($request->all());

        // send mail or store message in DB
        return redirect('/#contact')->with('success', 'Thank you! Your message has been sent.');
    }
}
