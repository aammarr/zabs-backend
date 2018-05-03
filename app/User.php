<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use Eloquent;
use App\Order;
use App\Item;
use App\Bid;
use App\Auction;


class User extends Authenticatable
{
    use SoftDeletes;

    use Notifiable, HasRoles;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'email', 'mobile', 'address', 'city', 'password', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];




    public static function bestUsers()
    {
        return DB::table('users')
            ->join('items', 'users.id', '=', 'items.user_id')
            ->groupBy('users.email', 'users.id')
            ->select('users.email', 'users.id', DB::raw('count(*) as items'))
            ->orderBy('items', 'desc')
            ->get();
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    // public function roles()
    // {
    //     return $this->belongsTo(Role::class);
    // }

    public function orders(){
        return $this->hasMany(Order::class);
    }


    public static function userShow(User $user)
    {
        return DB::table('products')
            ->where('user_id', '=', $user->id)
            ->get();
    }

    public function getCanPayAttribute() {
        return !!$this->getAttribute('stripe_customer_id');
    }

    public function getStripeIdAttribute() {
        return $this->getAttribute('stripe_customer_id');
    }

    public function authorizeRoles($roles){
        if (is_array($roles)) {
        return $this->hasAnyRole($roles) || 
             abort(401, 'This action is unauthorized.');
        }
        return $this->hasRole($roles) || 
         abort(401, 'This action is unauthorized.');
    }

    public function hasAnyRole($roles){
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }
  
    public function hasRole($role) {
        return null !== $this->roles()->where('name', $role)->first();
    }

}
