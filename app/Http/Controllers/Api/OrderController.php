<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Input as Input;
use Illuminate\Support\Facades\Validator; 

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderProduct;

use Config;
use Auth;
use DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /*************************************/
    
    public function getUserOrders(Request $request){
        
        $user_id        = $request['user']->id;
        $vendor_id      = $request->vendor_id;

        $o = new Order();
        $response = $o->getOrdersByUserId($user_id);

        if($response){
            return $this->sendResponse(Config::get('constants.status.OK'),$response, null);

        }   
        else{
            return $this->sendResponse(Config::get('constants.status.OK'),null, null);
        }    
    }

    /*************************************/

    public function postOrder(Request $request){

        $user_id        = $request['user']->id;
        $vendor_id      = $request->vendor_id;

        foreach($request->cart_ids as $c){
            $cart       = Cart::find($c);
            if($cart === NULL){

                return $this->sendResponse(Config::get('constants.status.OK'),"There is no cart with this Id", null);

            }
            // else{
                
            //     dd("Not empty");
            // }
        }

        $cartIds = implode(',',$request->cart_ids);
        $cartIds = $request->cart_ids;
        
        $o      =  new Order();
        $o->user_id     = $user_id;
        $o->vendor_id   = $vendor_id;
        $o->order_time  = date("Y-m-d h:i:s");
        $o->delivery_charges    = $request->delivery_charges;
        $o->status              = "pending";

        $o->name            = $request->name;
        $o->phone           = $request->phone;
        $o->address         = $request->address;
        $o->note            = $request->note;
        $totalPrice         = $request->delivery_charges;
        $o->total_amount    = $request->total_amount;
        
        // $o->save();

        foreach($cartIds as $c){
            
            $cart       = Cart::find($c);
            $product    = Product::find($cart->product_id);
            $op = new OrderProduct();        
            
            $op->user_id            = $user_id;
            $op->order_id           = $o->id;
            $op->vendor_id          = $vendor_id;
            $op->product_id         = $cart->product_id;
            $op->quantity           = $cart->quantity;

            $op->product_name        = $product->product_name;
            $op->product_description = $product->product_description;
            $op->product_pic_1       = $product->product_pic_1;
            $op->product_pic_2       = $product->product_pic_2;
            $op->product_pic_3       = $product->product_pic_3;
            $op->product_pic_4       = $product->product_pic_4;
            $op->product_pic_5       = $product->product_pic_5;
            $op->price               = $product->product_price * $cart->quantity;

            $op->save();

            $totalPrice = $totalPrice + $op->price;
            $o->total_amount = $totalPrice;
            
            $cart->delete();
        }
        $o->save();

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
    public function destroy($id)
    {
        //
    }
}
