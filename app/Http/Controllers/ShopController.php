<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    //
    public function index()
    {
        //get all data that should be loaded for the landing page
        //we should check if the user is logged in, if he/she is logged in,
        //we show them reccomended products,
        //recently viewed
        //products saved in cart
        //ect ... anything that you can think of

        $landingData = array(
            'dynamic-content' => 'you can pass a variable here, remove the quotes and add the $',
            'recommeneded' => ['we', 'can', 'pass', 'an', 'array', 'here']
        );

        return view('dynamic_pages.index')->with($landingData);
    }

    public function productDetail($p_id, $p_slug)
    {
        //
        $product = Product::where('id', $p_id)->where('slug', $p_slug)->first();

        if (!$product) return redirect()->back()->with('error', 'product not found');

        $product->total_views += 1;
        $product->save();

        $data = [
            'product' => $product,
            'product_photos' => $product->productPhotos
        ];

        return view('dynamic_pages.productDetail')->with($data);
    }
}
