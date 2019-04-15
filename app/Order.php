<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 * Package:
 * 
 * ORM for Order table
 * 
 */
class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'billing_email', 'billing_name', 'billing_address', 'billing_city',
        'billing_province', 'billing_phone', 'billing_name_on_card', 'billing_total',
        'error',
    ];

    /**
     * specify the relation between model
     * enable User to access this class
     * @return User
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * specify the relation between model
     * enable this class to access products
     * @return Product
     */
    public function products()
    {
        return $this->belongsToMany('App\Product')->withPivot('quantity');
    }
}
