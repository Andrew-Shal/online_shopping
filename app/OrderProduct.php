<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 * Package:
 * 
 * ORM for OrderProduct table
 * intermediary table has many to many relation
 *  order and product 
 * 
 */
class OrderProduct extends Model
{

    /**
     * explicitly name db table to map to
     * 
     * @var string
     */
    protected $table = 'order_product';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['order_id', 'product_id', 'quantity'];
}
