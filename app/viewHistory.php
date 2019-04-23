<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/*
 * ORM for a customer's product views
 * will be used as a means of recommending 
 * targeted products.
 *  
 */

class ViewHistory extends Model
{
    //
    protected $fillable = ['user_id', 'product_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
