<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    public $timestamps =true;
    protected $fillable = [
        'product_id', 'user_id', 'quantity', 'address', 'is_delivered'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }

}
