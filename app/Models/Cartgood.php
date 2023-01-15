<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cartgood extends Model
{
    use HasFactory;
    protected $fillable = [
        'cart_id',
        'good_id',
        'quantity',
    ];

    public function good() {
        return $this->belongsTo(Good::class);
    }

    public function total() {
        $good = $this->good;
        return $this->good->getPrice()*$this->quantity;
    }
}
