<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class Good extends Model
{
    use HasFactory;

    public function owner() {
        return $this->belongsTo(User::Class);
    }

    public function category() {
        return $this->belongsTo(Category::Class);
    }

    public function isOwnedByPartner() {
        $id = Auth::user()->id;
        $user = User::find($id);
        $owner = $this->owner;
        return $user->isPartnerWithOwner($owner);
    }

    public function getPrice() {
        if($this->isOwnedByPartner()) {
            return $this->price*0.9;
        }
        return $this->price;
    }

    protected $guarded = [];  
}
