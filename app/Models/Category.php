<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Log;
use DB;


class Category extends Model
{
    use SoftDeletes;
    protected $table = 'category';

	public function getAllCategories($vendor_id){
		$data = DB::table('category as c')
				->whereNull('deleted_at')
    			->where('c.vendor_id',$vendor_id)
    			->select('c.*')
    			->get();

    	return $data;
	}
}
