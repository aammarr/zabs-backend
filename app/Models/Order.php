<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Log;
use DB;

class Order extends Model
{	
	use SoftDeletes;
    protected $table = 'orders';

    public function getOrdersByUserId($user_id){

    	$orders = DB::table('orders as o')
                ->leftJoin('vendor as v','v.id','o.vendor_id')
    			->where('o.deleted_at',null)
    			->where('o.user_id',$user_id)
    			->select(
    				'o.*',
                    'v.name as vendor_name'
    			)
    			->orderBy('o.id','desc')
    			->get()->toArray();

        $prodData=[];
        foreach ($orders as $key => $value) {
        
            $value->products=[];
            $value->products = DB::table('order_products')
                            ->where('order_id',$value->id)
                            ->select('product_name')
                            ->get()->toArray();
        }
        
    	return $orders;
    }
}
