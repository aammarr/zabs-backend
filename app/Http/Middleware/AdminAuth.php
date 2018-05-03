<?php 

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class AdminAuth {

 /**
  * Validate Token request
  * 
  * @param unknown $request
  * @param Closure $next
  * @return Ambigous <\Symfony\Component\HttpFoundation\Response, \Illuminate\Contracts\Routing\ResponseFactory>
  */


 public function handle($request, Closure $next, $guard = null)
 {
  $request['admin_data']=Auth::user();

  if (Auth::guard($guard)->guest()) {
   if ($request->ajax() || $request->wantsJson()) {
    return response('Unauthorized.', 401);
   } else {
    #Flash::error('Please Login First');
    return redirect()->guest('login');
   }
  }
  if(session('full_authenticated')) {
   return $next($request);
  }else{
   Auth::logout();
   Session::flush();
   return redirect()->guest('login');
  }
 }
}