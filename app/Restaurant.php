<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'logo',
        'image_hero',
        'address',
        'long',
        'lat',
        'p_iva',
        'phone',
        'slug'
    ];


    /**
     * DB RELATIONSHIP
     */

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function products(){
        return $this->hasMany('App\Product');
    }

    public function categories(){
        return $this->belongsToMany('App\Category', 'restaurant_category');
    }


}
