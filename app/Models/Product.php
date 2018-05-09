<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Log;
use DB;


class Product extends Model
{
    use SoftDeletes;
    protected $table = 'products';

    public function getProductsByVendorAndCategoryId($vendor_id,$category_id){
    	
    	$data = DB::table('products as p')
    			->where('p.vendor_id',$vendor_id)
    			->where('p.category_id',$category_id)
    			->select(
                    'p.id',
                    'p.product_name',
                    'p.product_description',
                    'p.product_price',
                    'p.product_pic_1'
                )
                ->orderBy('p.id','desc')
                ->get();

    	return $data;
    }

    public function getProductsByVendorId($vendor_id){
        
        $data = DB::table('products as p')
                ->where('p.vendor_id',$vendor_id)
                ->select(
                    'p.id',
                    'p.product_name',
                    'p.product_description',
                    'p.product_price',
                    'p.product_pic_1'
                )
                ->orderBy('p.id','desc')
                ->get();

        return $data;
    }

    public function getProductByProductId($vendor_id,$product_id){

    	$data = DB::table('products as p')
                ->where('p.vendor_id',$vendor_id)
    			->where('p.id',$vendor_id)
    			->select(
                    'p.id',
                    'p.product_name',
                    'p.product_description',
                    'p.product_price',
                    'p.product_pic_1',
                    'p.product_pic_2',
                    'p.product_pic_3',
                    'p.product_pic_4',
                    'p.product_pic_5'
                )
    			->orderBy('p.id','desc')
                ->get();

    	return $data;
    }
}
