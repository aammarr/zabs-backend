<?php

namespace App\Http\Middleware;

use Closure;

use App\Exceptions\UnAuthorizedRequestException;
use Illuminate\Contracts\Auth\Guard;
use App\Libraries\APIResponse;
use Illuminate\Http\Response;
use Config;
use DB;

class ApiAuth
{   
    use APIResponse;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $access_token = $request->header('Authorization');
        $access_token = str_replace("Bearer ","",$access_token);

        if($access_token){
            $user = \App\User::where('access_token',$access_token)->first();
            if($user){
                $request->merge(array("user"=>$user));

                return $next($request);
            }
        }
        
        return $this->sendResponse(401,
                                    null,
                                    ['Unauthorized access_token'],
                                    401)->header('Content-Type', 'application/json');
    }
}
