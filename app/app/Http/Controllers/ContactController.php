<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'message' => 'required|string|max:2000',
        ]);

        // Send email
        Mail::to('emmanuelayofame@gmail.com')->send(new ContactFormMail($validated));

        return back()->with('success', 'Your message has been sent successfully!');
    }
}
