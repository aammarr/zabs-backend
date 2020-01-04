<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Log;
use DB;

class Order extends Model
{
     use SoftDeletes;
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public function getOrderDetailsById($order_id){

        $order = DB::table('order_products as op')
                ->leftJoin('orders as o','o.id','op.order_id')
                ->leftJoin('products as p','p.id','op.product_id')
                ->where('o.id',$order_id)
                ->where('o.deleted_at',null)
                ->select(
                    'o.id as order_id',
                    'o.order_time as order_time',
                    'o.delivery_charges as delivery_charges',
                    'o.total_amount as total_amount',
                    'o.status as status',
                    'o.name as name',
                    'o.phone as phone',
                    'o.address as address',
                    'o.note as note',
                    'p.product_price as product_price',
                    'op.id as order_product_id',
                    'op.product_id as product_id',
                    'op.quantity as quantity',
                    'op.product_name as product_name',
                    'op.product_description as product_description',
                    'op.product_pic_1 as product_pic_1',
                    'op.product_pic_2 as product_pic_2',
                    'op.product_pic_3 as product_pic_3',
                    'op.product_pic_4 as product_pic_4',
                    'op.product_pic_5 as product_pic_5',
                    'op.price as total_price'
                )
                ->get();

        return $order;

    }

    public function orderAccept($order_id){
        $data = $this::findOrFail($order_id);
        if($data){
            $this::where('id',$order_id)->update(['status'=>'accepted']);
            return true;
        }
        else{
            return false;
        }

    }

    public function orderReject($order_id){
        $data = $this::findOrFail($order_id);
        if($data){
            $this::where('id',$order_id)->update(['status'=>'rejected']);
            return true;
        }
        else{
            return false;
        }

    }
}
