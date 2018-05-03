<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

use App\Exceptions\UnAuthorizedRequestException;
use App\Libraries\APIResponse;
use Illuminate\Http\Response;
use App\User;
use Config;
use DB;

class ValidateClient
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
        $client_id = $request->header('client_id');
        $authorization_header = $request->header('Authorization');
        $client_secret = str_replace("Basic ","",$authorization_header);
        $client = DB::table('clients')
                    ->where('client_id', $client_id)
                    ->where('client_secret',$client_secret)
                    ->first();

        if($client){
            return $next($request);
        }

        $access_token = $request->header('Authorization');
        $access_token = str_replace("Bearer","",$access_token);

        if($access_token){
            $user = \App\Model\User::where('access_token',$access_token)->first();
            
            if($user){
                $request->merge(array("user"=>$user));
                return $next($request);
            }
        }
        
        return $this->sendResponse(Config::get('error.code.NOT_FOUND'),
                null,
                ['Unauthorized Request'],
                Config::get('error.code.NOT_FOUND'));
    }
}
