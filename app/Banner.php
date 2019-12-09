<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Log;
use DB;

class Banner extends Model
{
    
    use SoftDeletes;
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'banners';

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
    protected $fillable = ['banner 01'];

    public function geBannersbyVendor_id($vendor_id){
        $data = DB::table('banners as b')
                ->where('b.vendor_id',$vendor_id)
                ->select('b.id','b.vendor_id','b.banner')   
                ->get();

        return $data;
    }


}
