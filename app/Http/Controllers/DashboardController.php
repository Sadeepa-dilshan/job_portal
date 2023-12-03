<?php

namespace App\Http\Controllers;

use Mail;
use App\Models\User;
use App\Mail\TestMail;
use App\Mail\JobPosted;
use App\Models\JobBank;
use App\Models\Category;
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


        // Dynamic Job Details 
        $user = Auth::user();

        // Check if the user instance is found
        if ($user) {
            // Retrieve the categories associated with the user
            $categories = $user->categories;

            // Initialize an array to store related job details
            $jobDetails = [];

            // Iterate through each category and retrieve associated job banks with selected fields
            foreach ($categories as $category) {
                // Retrieve job banks related to the current category with selected fields
                $jobBanks = $category->jobBanks()->select('company_name', 'post', 'closing_date', 'location', 'mobile_number')->get();

                // Merge the job banks into the result array
                $jobDetails = array_merge($jobDetails, $jobBanks->toArray());
            }

            // If you want to remove duplicates, you can use array_unique
            $jobDetails = array_unique($jobDetails, SORT_REGULAR);

            // Now, $jobDetails contains all the related job details for the user with selected fields
        } else {
            // Handle the case when the user is not found, for example, set $jobDetails to an empty array or show an error message
            $jobDetails = [];
        }

        Mail::to('user@gmail.com')->send(new TestMail($subject,$body,$jobDetails));
        return back()->with('success','We sent all the jobs related to you!');
    }

    // get category
    
    public function editCategoriesForm()
    {
        $user = auth()->user(); // Assuming you are using Laravel's built-in authentication
    
        $categories = Category::all();
    
        return view('dashboard', compact('user', 'categories'));
    }
    
    public function updateCategories(Request $request)
    {
        $user = auth()->user(); // Assuming you are using Laravel's built-in authentication
    
        $user->categories()->sync($request->input('categories'));
    
        return redirect()->route('dashboard')->with('success', 'Categories updated successfully.');
    }

    // post job

    public function createJob(){

        $categories = Category::all();
        return view('post-job', compact('categories'));
        return view('post-job');
    }

    public function postJob(Request $request)
    {
        $jobBank = new JobBank();
        $jobBank->company_name = $request->input('company_name');
        $jobBank->post = $request->input('post');
        $jobBank->closing_date = $request->input('closing_date');
        $jobBank->location = $request->input('location');
        $jobBank->mobile_number = $request->input('mobile_number');

        // Assuming 'category_id' is the foreign key in the 'JobBank' model
        $jobBank->category_id = $request->input('category_id');

        $jobBank->save();

        $users = $jobBank->category->users;

        // Send email to each user
        foreach ($users as $key => $user) {
            Mail::to($user->email)->send(new JobPosted($jobBank, $user));
        }
        
        return back()->with('success', 'Job created successfully!');
    }
}
