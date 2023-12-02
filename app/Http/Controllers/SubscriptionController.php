<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Models\User;
use App\Mail\PurchaseMail;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use App\Http\Middleware\isEmployer;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;

class SubscriptionController extends Controller
{
    const WEEKLY_AMOUNT = 20;
    const MONTHLY_AMOUNT = 80;
    const YEARLY_AMOUNT = 100;
    CONST CURRENCY = 'USD'; 

    public function __construct()
    {
        $this->middleware(['auth', isEmployer::class]);
    }

    public function subscribe()
    {
        return view('subscription.index');
    }
    public function initiatePayment(Request $request)
    {
        $plans = [
            'weekly' => [
                'name' => 'weekly',
                'description' => 'weekly payment',
                'amount' => self::WEEKLY_AMOUNT,
                'currency' => self::CURRENCY,
                'quantity' => 1,   
            ],
            'monthly'=> [
                'name' => 'monthly payment',
                'description' => self::MONTHLY_AMOUNT,
                'amount' => self::CURRENCY,
                'quantity' => 1,
            ],
            'yearly'=> [
                'name' => 'yearly payment',
                'description' => self::YEARLY_AMOUNT,
                'amount' => self::CURRENCY,
                'quantity' => 1,
            ],
        ];

        Stripe::setApiKey(config('services.stripe.secret'));

        // initiate payment
        try{
            $selectPlan = null;
            if ($request->is('pay/weekly')) 
            {
                $selectPlan =  $plans['weekly'];
                $billingEnds = now()->addWeek()->startOfDay()->toDateString();
            }
            elseif($request->is('pay/monthly'))
            {
                $selectPlan =  $plans['monthly'];
                $billingEnds = now()->addMonth()->startDate()->toDateString();
            }
            elseif($request->is('pay/yearly'))
            {
                $selectPlan =  $plans['yearly'];
                $billingEnds = now()->addYear()->startDate()->toDateString();
            }
            if ($selectPlan) {
                $successURL = URL::signedROute('payment.success',[
                    'plan' => $selectPlan['name'],
                    'billing_ends'=>$billingEnds
                ]);
                $session = Session::create([
                    'payment_method_types' => ['card'],
                    'line_items' => [
                        [
                            'name' => $selectPlan['name'],
                            'description' => $selectPlan['description'],
                            'amount'=>$selectPlan['amount']*100,
                            'currency'=> $selectPlan['currency'],
                            'quantity'=> $selectPlan['quantity'],
                        ],
                        
                    ],
                    // what the current plan selected
                    'success_url'=>$successURL,
                    'cancel_url' => route('payment.cancel')
                ]);
                dd($session);
            }
          

        }catch(\Exception $e){
            return response()->json($e);
        }
    }
    public function paymentSuccess(Request $request)
    {
        // update db
        $plan = $request->plan;
        $billingEnds = $request->billing_ends;
        User::where('id', auth()->user()->id)->update([
            'plan'=> $plan,
            'billing_ends' =>$billingEnds,
            'status' =>'paid'
        ]);
        try{
            // $plan = 'weekly';
            // $billingEnds = date('Y-m-d H:i:s');            
            Mail::to(auth()->user())->queue(new PurchaseMail($plan,$billingEnds));
        }
        catch(\Exception $e)
        {
            return $e;
            return response()->json($e);
        }

       
        
        return redirect()->route('payment.success')->with('success','Payment was successfully processed');
    }
    public function cancel()
    {
        return redirect()->route('dashboard')->with('error','Payment was unsuccessfully processed');
    }  
}
