<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 * Package:
 * 
 * ORM for Posts table
 * presents a user's post
 * 
 */
class Post extends Model
{

    /** 
     * 
     * create a relation between both models
     * 
     * @return  User
     * 
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
