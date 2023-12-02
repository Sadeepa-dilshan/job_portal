<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\TestMail;

class TestController extends Controller
{ 
    public function index()
    {
        $subject = 'Code code code';
        $body = 'Test Message';
        
        Mail::to('user@gmail.com')->send(new TestMail($subject,$body));
    }
    
}
