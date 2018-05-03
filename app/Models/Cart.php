<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Log;
use DB;


class Cart extends Model
{   
    use SoftDeletes;
    protected $table = 'carts';

    public function getUserCart($user_id){

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

    	return $data;
    }
}
