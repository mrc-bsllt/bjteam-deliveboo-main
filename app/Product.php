<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'restaurant_id',
        'name',
        'slug',
        'image',
        'description',
        'price',
        'is_vegetarian',
        'is_glutenfree',
    ];

    /**
     * DB RELATIONSHIP
     */

    public function orders(){
        return $this->belongsToMany('App\Order', 'product_order');
    }

    public function restaurant(){
        return $this->belongsTo('App\Restaurant');
    }

}
