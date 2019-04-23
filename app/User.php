<?php

namespace App;

use App\Enums\AccountStatus;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * 
 * Package:
 * 
 * ORM of an online user
 * buyer and seller has the 
 * same functionality
 * 
 * User inherits authenticatable
 * from laravel auth feature, used for 
 * authenticating users,
 * 
 * User implements the contract MustVerifyEmail
 * in order to send emais 
 * 
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'cust_country',
        'cust_city', 'cust_street', 'phone_number', 'account_status',
        'seller_panel_enabled', 'password',
    ];

    /**
     * The attributes that defaults when not assigned
     * on instantiation
     *
     * @var array
     */
    protected $attributes = array(
        'account_status' => AccountStatus::PREACTIVE,
        'seller_panel_enabled' => 0
    );

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Relational mapping between Models
     */

    /** 
     * 
     * User instance can now have access to Posts
     * that belongs to the user 
     * 
     * @return  Post
     * 
     */
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    /** 
     * 
     * User instance can now have access to Products
     * that belongs to the user 
     * 
     * @return  Product
     * 
     */
    public function products()
    {
        return $this->hasMany('App\Product');
    }

    /** 
     * 
     * User instance can now have access to Ratings
     * that belongs to the user 
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
     * User instance can now have access to BillingInformation
     * that belongs to the user 
     * 
     * @return  Product
     * 
     */
    public function billing()
    {
        return $this->hasOne('App\Billing');
    }

    public function viewHistory()
    {
        return $this->hasMany('App\ViewHistory');
    }
}
