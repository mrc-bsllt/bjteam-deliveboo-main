<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'total_price',
        'guest_name',
        'guest_address',
        'email_customer'
    ];

    /**
     * DB RELATIONSHIP
     */
    public function products(){
        return $this->belongsToMany('App\Product', 'product_order');
    }
}
