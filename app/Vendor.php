<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'vendor';

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
    protected $fillable = ['name', 'email', 'password', 'description', 'address', 'city', 'country', 'phone', 'avatar'];

    
}
