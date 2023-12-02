<?php

// app/Http/Controllers/EmailController.php
namespace App\Http\Controllers;

use App\Mail\MyCustomEmail;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail()
    {
        $emailData = ['name' => 'John Doe'];

        // Send Email using Mailable
        Mail::to('mgsdilshan2535@gmail.com')->send(new MyCustomEmail($emailData));

        // Return a view or a response if needed
        return view('emails.sent', ['name' => $emailData['name']]);
    }
}
