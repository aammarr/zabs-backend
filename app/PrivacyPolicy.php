<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class PrivacyPolicy extends Model
{
     protected $table = 'privacy_policy';

     public function getPrivacyPolicy($limit){

    	$data = DB::table('privacy_policy as p')
    			->select('p.message')
    			->paginate()->items($limit);

    	return $data;
    }
}
