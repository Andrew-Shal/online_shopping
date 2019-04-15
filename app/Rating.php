<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 * Package:
 * 
 * ORM for rating table
 * Ratings will be used primarily
 * for the recommender engine
 * being implemented
 * 
 */
class Rating extends Model
{
    /**
     * The attributes that defaults when not assigned
     * on instantiation
     *
     * @var array
     */
    protected $attributes = array(
        'product_id' => 0,
        'user_id' => 0,
        'rating' => 0,
        'review' => ''
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
