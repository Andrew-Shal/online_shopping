<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 * Package:
 * 
 * ORM for productphotos table
 * holds a product's many photos
 * 
 */
class ProductPhoto extends Model
{

    /**
     * The attributes that defaults when not assigned
     * on instantiation
     *
     * @var array
     */
    protected $attributes = array(
        'photo' => '/public/defaults/noimage.jpg',
        'product_id' => 0,
    );

    /**
     * enables an instance to access its
     * owner(s) -> Product
     * @return Product
     * 
     */
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
