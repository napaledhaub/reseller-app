<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Good;

class Order extends Model
{
    use HasFactory;

    public function dropshipper() {
        $dropshipper = User::where('id', $this->dropshipper_id)->first();
        return $dropshipper;
    }

    public function owner() {
        $owner = User::where('id', $this->owner_id)->first();
        return $owner;
    }

    public function ordergoods() {
        return $this->hasMany(Ordergood::class);
    }

    public function frontGoodsDisplayName() {
        $ordergood = Ordergood::where('order_id',$this->id)->first();
        $count = Ordergood::where('order_id',$this->id)->count();
        if($count > 1) {
            $count -= 1;
            return $ordergood->good->good_name . "+ " . $count . " more goods";
        }
        return $ordergood->good->good_name;
    }

    
    public function frontGoodsDisplayQuantity() {
        $ordergood = Ordergood::where('order_id',$this->id)->first();
        return $ordergood->quantity;
    }

    public function frontGoodDisplayPicture() {
        $ordergood = Ordergood::where('order_id', $this->id)->first();
        return $ordergood->good->good_picture;
    }

    public function isPending(){
        if($this->status == "Payment Approved") {
            return true;
        }
        return false;
    }

    public function isSent(){
        if($this->status == "Goods Sent") {
            return true;
        }
        return false;
    }

    public function isRejected() {
        if($this->status == "Payment Rejected") {
            return true;
        }
        return false;
    }

    public function isWaitingPaymentApproval() {
        if($this->status == "Waiting Payment Approval") {
            return true;
        }
        return false;
    }

    protected $guarded = [];
}
