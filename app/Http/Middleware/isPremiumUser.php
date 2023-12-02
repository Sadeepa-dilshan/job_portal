<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;
class isPremiumUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $currentDateTime = Carbon::now();

        if($request->user()->billing_ends > $currentDateTime || $request->user()->user_trial > $currentDateTime)
        {
            return $next($request);
        }
        
         return redirect()->route('subscribe')->with('message','please subscribe to post a job');
       
    }
}
