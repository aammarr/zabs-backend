<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Log;
use DB;

class Settings extends Model
{
    use SoftDeletes;

    protected $table = 'settings';


    public function getTnC($vendor_id){
    	$data = $this::where('vendor_id',$vendor_id)
    	->select('t_n_c as terms_n_condition')
    	->first();

    	return $data;
    }

    public function getDeliveryFee($vendor_id){
    	$data = $this::where('vendor_id',$vendor_id)
    	->select('delivery_fee')
    	->first();

    	return $data;
    }
}
