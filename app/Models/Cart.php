<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'owner_id',
        'address',
    ];

    public function cartgoods() {
        return $this->hasMany(Cartgood::class);
    }

    public function cartgoodWithGood($id){
        return $this->cartgoods()->where('good_id',$id)->first();
    }

    public function total() {
        $total = 0;
        foreach($this->cartgoods as $cartgood){
            $subtotal = $cartgood->total();
            $total += $subtotal;
        }
        return $total;
    }

    public function owner(){
        return User::find($this->owner_id);
    }
}
