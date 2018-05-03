<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Auth;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */

    public function __construct()
    {       
        $this->middleware('auth');
        return redirect('home');

        $this->middleware(function (Request $request, $next) {
            
         //    $user = \Auth::user();

         //    if ( $user->role_id == 3 ) {
         //    	dd('/excissse');
	        // }
	        // else if ( $user->role_id == 4 ) {
         //    	dd('/sales_aacenter');
	        // }
	        // else{
	        // 	// dd('azzxx');
	        // 	\Auth()->logout();
	        // }


        });

    }

    public function index()
    {
    	return view('admin.dashboard');
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
    }
}
