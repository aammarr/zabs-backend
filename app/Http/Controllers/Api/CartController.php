<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Input as Input;
use Illuminate\Support\Facades\Validator; 

use App\Models\Cart;
use App\Models\Product;

use Config;
use Auth;
use DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd('cart controller index');
    }

    public function getCart(Request $request){

        $user_id        = $request['user']->id;

        $c          = new Cart();
        $response   = $c->getUserCart($user_id);
        // dd($response);
        if($response){
            return $this->sendResponse(Config::get('constants.status.OK'),$response, null);
        }
        else{
            return $this->sendResponse(Config::get('constants.status.OK'),null, null);
        }
    }

    public function postCart(Request $request){
        

        $user_id        = $request['user']->id;
        $product_id     = $request->product_id;
        $quantity       = $request->quantity;
        // $product_price  = $request->product_price;
        // $total_price    = $request->total_price;
        
        $c = new Cart();
        $c->user_id         = $user_id;
        $c->product_id      = $product_id;
        $product = Product::where('deleted_at',null)
                            ->where('id',$product_id)
                            ->select('*')
                            ->first();
        $c->quantity        = $quantity;
        $c->product_price   = $product->product_price;
        $c->total_price     = $product->product_price*$quantity;
        $c->save();


        return $this->sendResponse(Config::get('constants.status.OK'),null, null);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cart_id)
    {
        $cart = Cart::find($cart_id);
        
        if($cart){
            
            $cart->delete($cart_id);

            return $this->sendResponse(Config::get('constants.status.OK'),'Cart has been succesfully deleted.', null);
        }
        else{
            $error = "No Cart Found"; 
            return $this->sendResponse(Config::get('constants.status.OK'),null, $error);
        }
        
        dd($cart);
        
    }
}
