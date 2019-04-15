<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * 
 * Package:
 * 
 * ORM for products table
 * This model has association
 * with other models
 * 
 */
class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'current_price', 'qty', 'featured_photo',
        'filename', 'description', 'condition', 'return_policy',
    ];

    /**
     * The attributes that defaults when not assigned
     * on instantiation
     *
     * @var array
     */
    protected $attributes = array(
        'is_active' => 1,
        'featured_photo' => 'noimage_placeholder.jpg',
        'total_views' => 0,
        'ecat_id' => 1,
    );


    /**
     * enables an instance to access its
     * owner(s) -> User
     * @return User
     * 
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /** 
     * 
     * Product instance can now have access to ProductPhotos
     * that belongs to the Product 
     * 
     * @return  ProductPhoto
     * 
     */
    public function productPhotos()
    {
        return $this->hasMany('App\ProductPhoto');
    }

    /** 
     * 
     * Product instance can now have access to Ratings
     * that belongs to the Product 
     * 
     * @return  Rating
     * 
     */
    public function ratings()
    {
        return $this->hasMany('App\Rating');
    }

    /** 
     * 
     * Helper function that formats float price to currency format 
     * 
     * @return  String
     * 
     */
    public function presentPrice()
    {
        return "$" . number_format($this->current_price, 2, '.', ',');
    }
}
