<?php

namespace App\Http\Controllers;

use App\User;
use App\Product;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function index()
    {
        // get recommended products
        $user = null;
        $recommendations = null;

        if (auth()->user()) {
            $user = User::find(auth()->user()->id);

            $recommendations = $user->recommendationOnRating ?  $user->recommendationOnRating->recommendation_on_ratings : null;
            $recommendations = unserialize($recommendations);
        }

        $products = array();
        foreach ($recommendations as $key => $recommended_product) {

            $product = Product::find(trim($key, 'p'));
            array_push($products, $product);
        }
        // end of recommended products

        $recently_added = Product::where('is_active', 1)
            ->orderBy('created_at', 'asc')
            ->take(10)
            ->get();


        $landingData = [
            'products' => $products,
            'user' => $user,
            'recently_added' => $recently_added
        ];

        return view('dynamic_pages.index')->with($landingData);
    }

    public function about()
    {
        return view('static_pages.about');
    }
    public function contact()
    {
        return view('static_pages.contact');
    }

    public function services()
    {
        $data = array(
            'h1Title' => 'Online Shopping Services',
            'services' => ['Web Design', 'Programmins', 'SEO']
        );

        return view('static_pages.services')->with($data);
    }

    public function enabling_seller_panel()
    {
        return view('static_pages.enable_sellers');
    }
}
