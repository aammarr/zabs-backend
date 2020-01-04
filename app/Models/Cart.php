<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Log;
use DB;

class Cart extends Model
{   
    use SoftDeletes;
    protected $table = 'carts';

    public function getUserCart($user_id){
        $cart_total=0;
    	$data = DB::table('carts as c')
    			->leftJoin('products as p','p.id','c.product_id')
    			->where('c.deleted_at',null)
    			->where('c.user_id',$user_id)
    			->select(
    				'c.id',
    				'c.user_id',
    				'c.product_id',
    				'c.quantity',
    				'p.product_name',
    				'p.product_pic_1',
    				'c.total_price'
    			)
    			->orderBy('c.id','desc')
    			->get();


        // foreach($data as $d){
                        
            // $cart_total+=$d->total_price;
            // $cart_total=$cart_total+$d->total_price;
            // $cart_total=bcadd($d->total_price,$d->total_price,1);
        // }


        // $data['cart_total']=$cart_total;
        // dd($data);        
    	return $data;
    }

    public function saveNewCart($request){

        $user_id        = $request['user']->id;
        $product_id     = $request['product_id'];
        $quantity       = $request['quantity'];

        // $product_price  = $request['product_price'];
        // $total_price    = $request->total_price;
        $product = Product::where('deleted_at',null)
                            ->where('id',$product_id)
                            ->select('*')
                            ->first();
        
        $product_price   = $product->product_price;
        $total_price     = $product->product_price*$quantity;

        $preCart = $this->getUserCart($user_id);
        
        if(empty($preCart) != false){
            foreach($preCart as $data){
                
                if($data->product_id == $product_id){
                    $quantity++;
                    $this::where('user_id', $user_id)
                    ->where('product_id', $product_id)
                    ->update(['quantity' => $quantity,'total_price'=>$data->total_price+$total_price]);
                }
            }

        }
        else{
            $postData['user_id']= $user_id;
            $postData['product_id']= $product_id;
            $postData['quantity']= $quantity;
            $postData['product_price']= $product_price;
            $postData['total_price']= $total_price;
            $this->insert($postData);

        }
        


        dd("amar");
    }
}
