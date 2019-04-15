<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 * Package:
 * 
 * ORM for Billing table
 * 
 */
class Billing extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $attributes = array(
        'billing_email' => '',
        'billing_name' => '',
        'billing_address' => '',
        'billing_city' => '',
        'billing_province' => '',
        'billing_phone' => '',
        'user_id' => 0
    );

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
     * 
     * @return Boolean
     */
    public function isBillingIncomplete()
    {
        foreach ($this->attributes as $field) {
            if (empty($field)) {
                return true;
            }
        }
        return false;
    }
}
