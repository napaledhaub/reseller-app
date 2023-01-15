<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable;
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'address',
        'phone',
        'ktp',
        'description',
        'picture'
    ];

    protected $table = 'users';

    public $timestamps = false;

    public function goods() {
        return $this->hasMany(Good::class);
    }

    public function carts() {
        return $this->hasMany(Cart::class);
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function getOwnerPartner() {
        $partnerships = Partner::where('owner_id','=',$this->id)->get();
        return $partnerships;
    }

    public function getDropshipperPartner() {
        $partnerships = Partner::where('dropshipper_id','=',$this->id)->get();
        return $partnerships;
    }

    public function getCartWithOwner($ownerId){
        $dropshipperId = Auth::user()->id;
        // $cart = DB::table('carts')
        //             ->where('owner_id', '=', $ownerId)
        //             ->where('user_id', '=', $this->id)
        //             ->first();
        
        $cart = Cart::where([
            ['owner_id', '=', $ownerId],
            ['user_id', '=', $this->id],
        ])->first();

        return $cart;
    }


    public function isPartnerWithOwner(User $owner){
        // $id = Auth::user()->id;

        $result = DB::table('partners')
                    ->where('owner_id', '=', $owner->id)
                    ->where('dropshipper_id', '=', $this->id)
                    ->first();
        if($result == null){
            return false;
        }
        return true;
    }


    public function isPartnerWithDropshipper(){
        $id = Auth::user()->id;

        $result = DB::table('partners')
                    ->where('owner_id', '=', $id)
                    ->where('dropshipper_id', '=', $this->id)
                    ->first();
                    
        if($result == null){
            return false;
        }
        return true;
    }

    public function isAdmin(){
        if($this->role == 3){
            return true;
        }
        return false;
    }
}
