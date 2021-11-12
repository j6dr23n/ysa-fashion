<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','name','ph_number','address','discount','discount_code','ordercode','subtotal',
        'total','error'
    ];

    public function products()
    {
        return $this->belongsToMany('App\Models\Product')->withPivot('quantity','color','size');
    }
}
