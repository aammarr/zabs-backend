<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\HasRoles;
use Illuminate\Database\Eloquent\softDeletes;

class Role extends Model
{

    use SoftDeletes;

    protected $table = 'role_user';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'label'];


    
    public function user(){
        return $this->hasManyThrough(Role::class);
    }

    
}
