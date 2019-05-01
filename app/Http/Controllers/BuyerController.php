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

        // get recommended products
        $recommendations = null;

        $recommendations = $user->recommendationOnRating ?  $user->recommendationOnRating->recommendation_on_ratings : null;
        $recommendations = unserialize($recommendations);

        $products = array();
        if ($recommendations) {
            foreach ($recommendations as $key => $recommended_product) {

                $product = Product::find(trim($key, 'p'));
                if ($product) {
                    array_push($products, $product);
                }
            }
            // end of recommended products

        }


        $data = [
            'user' => $user,
            'billingInfo' => $billingInfo,
            'products' => $products
        ];

        return view('dynamic_pages.buyer.index')->with($data);
    }
}
