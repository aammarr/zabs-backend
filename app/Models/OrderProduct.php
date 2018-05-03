<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Log;
use DB;


class OrderProduct extends Model
{
    use SoftDeletes;
    protected $table = 'order_products';
}
