<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Good;

class Ordergood extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'good_id',
        'quantity',
        'total'
    ];

    public function good() {
        return $this->belongsTo(Good::class);
    }
}
