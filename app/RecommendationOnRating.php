<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecommendationOnRating extends Model
{
    //
    protected $fillable = ['user_id', 'recommendation_on_ratings',];


    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
