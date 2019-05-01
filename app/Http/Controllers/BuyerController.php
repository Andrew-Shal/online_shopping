<?php

namespace App\Http\Controllers;

use App\Product;
use App\Rating;
use App\User;
use App\ViewHistory;
use App\Recommender;
use App\RecommendationOnRating;
use Illuminate\Http\Request;
use function Opis\Closure\unserialize;

class BuyerController extends Controller
{

    //   return view('dynamic_pages.buyer.index');

    public function index()
    {
        $user = User::find(auth()->user()->id);

        $billingInfo = $user->billing;

        $data = [
            'user' => $user,
            'billingInfo' => $billingInfo
        ];

        return view('dynamic_pages.buyer.index')->with($data);
    }
}
