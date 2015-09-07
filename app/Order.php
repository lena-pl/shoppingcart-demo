<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = ['total_price', 'shipping_address', 'shipping_method'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products')
        ->withPivot('quantity', 'price')
        ->withTimestamps();
    }

}
