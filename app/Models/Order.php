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

    	$data = DB::table('orders as o')
    			->where('o.deleted_at',null)
    			->where('o.user_id',$user_id)
    			->select(
    				'o.*'
    			)
    			->orderBy('o.id','desc')
    			->get();

    	return $data;
    }
}
