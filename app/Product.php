<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Log;
use DB;

class Product extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

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
    protected $fillable = [
                    'product_name',
                    'product_description',
                    'product_price',
                    'product_pic_1',
                    'product_pic_2',
                    'product_pic_3',
                    'product_pic_4', 
                    'product_pic_5',
                    'category_id'
                ];

    
}
