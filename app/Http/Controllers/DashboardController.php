<?php

namespace App\Http\Controllers;

use Mail;
use App\Models\User;
use App\Mail\TestMail;
use App\Models\JobBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{   
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        return view('dashboard');
    }
    public function verify(){
        return view('user.verify');
    }
    public function resend(Request $request)
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('dashboard')->with('message','Your email was verified');
        }

         $user->sendEmailVerificationNotification();

         return back()->with('success','Verification link sent successfully');
    }
    public function mailme()
    {
        $subject = 'Code code code';
        $body = 'Test Message';
        // $jobDetails = [
        //     ['title' => 'Software Engineer', 'description' => 'We are hiring a skilled software engineer with experience in Laravel.'],
        //     ['title' => 'Marketing Specialist', 'description' => 'Join our marketing team and help us promote our products.'],
        //     // Add more dynamic job details as needed
        // ];

        // Dynamic Job Details (retrieve from the users table in the database)
        $jobDetails = JobBank::select('company_name', 'post', 'closing_date', 'location', 'mobile_number')->get()->toArray();

        
        Mail::to('user@gmail.com')->send(new TestMail($subject,$body,$jobDetails));
    }
}
