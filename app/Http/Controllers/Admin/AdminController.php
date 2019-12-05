<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Auth;
use App\Category;
use App\ContactUs;
use App\Order;
use App\Product;
use App\User;
use View;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */

    public function __construct()
    {      
        return view('admin/dashboard');
        // return redirect('home');
    }

    public function index()
    {   
        $this->middleware('auth');
        // $this->middleware(function (Request $request, $next) {});

        $user = \Auth::user();

        if ( $user->role_id == 1 ) {
            $user       = User::all();
            $products   = Product::all();
            $messages   = ContactUs::all();
            $categories = Category::all();
            $orders     = Order::all();
            

            $dataPoints = array( 
                            array("label"=>"Users", count($user)),
                            array("label"=>"Products", count($products)),
                            array("label"=>"Categories", count($categories)),
                            array("label"=>"Messages", count($messages)),
                            array("label"=>"Orders", count($orders))
                        );

            return view('admin.dashboard')->with('dataPoints',$dataPoints);
            dd('/super admin');
        }
        else if ( $user->role_id == 2 ) {
            dd('/vendor admin');
        }
        else{
            // dd('azzxx');
            \Auth()->logout();
        }

    }

    public function logout(Request $request) {

        $id         = $request['user']->id;
        $user_email = $request['user']->email;

        $user = User::where('email',$user_email)->get()->first();
        
        $user->access_token = null;
        $user->gcm_token = null;
        $user->save(); 
        
        Auth::logout();
        return redirect('/login');
    }
}
