<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    public $timestamps =true;
    protected $fillable = [
        'name', 'price', 'units', 'description', 'image'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    public function orders(){
        return $this->hasMany(Order::class);
    }
}
