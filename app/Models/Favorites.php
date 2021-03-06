<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Log;
use DB;

class Favorites extends Model
{
    use SoftDeletes;
    protected $table = 'favorites';

    public function getUserFavorites($user_id){

    	$data = $this::leftJoin('products as p','p.id','favorites.product_id')
    			->whereNull('favorites.deleted_at')
    			->where('favorites.user_id',$user_id)
    			->where('favorites.favorite',1)
    			->select('p.*')
    			->get();

    	return $data;
    }

    public function updateUserFavorites($request){


        $data['user_id'] = $request->user['id'];
        $data['product_id'] = $request->product_id;
        $data['favorite'] = $request->favorite;
        $data['created_at'] = date('Y-m-d H:i:s');

        $userFavoriteData = $this::where([
		        	'user_id'=>$data['user_id'],
		        	'product_id'=>$data['product_id']
		        	])->get()->toArray();

        if($userFavoriteData){
        	$this::where('user_id',$data['user_id'])
        			->where('product_id',$data['product_id'])
        			->update(['favorite'=>$data['favorite']]);
        }
        else{

        	$this::insert($data);
        	
        }

    	return $data;
    }
}
