<?php

namespace App\Http\Middleware;

use Closure;
use Log;

class CustomLog
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //PreMiddleware: Log request Headers & Parameters
        Log::info($request->url());
        Log::info($request->headers);
        Log::info($request);


        \DB::enableQueryLog();

        //Executed request & response
        $response = $next($request);

        //PostMiddleware: Log the database queries
        $queries = \DB::getQueryLog();
        Log::info($queries);

        return $response;
    }
}
