<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Partner extends Model
{
    protected $fillable = ['owner_id', 'dropshipper_id'];
    use HasFactory;

    // public function dropshipper(){
    //     return $this->belongsTo(User::Class);
    // }

    // public function owner(){
    //     return $this->belongsTo(Good::Class);
    // }

    public function owner() {
        $owner = User::where('id', $this->owner_id)->first();
        return $owner;
    }
    
    public function dropshipper() {
        $dropshipper = User::where('id', $this->dropshipper_id)->first();
        return $dropshipper;
    }
}
