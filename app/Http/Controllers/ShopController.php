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

    public function productList()
    {
        $products = Product::where('is_active', 1)
            ->orderBy('created_at', 'asc')
            ->paginate(20);
        return view('dynamic_pages.productList')->with('products', $products);
    }

    public function productSearch(Request $request)
    {
        $input = $request->input();
        $search = $request->query('search_param');

        if (!$search) return redirect()->route('shop.product.list');

        $products = Product::like('name', $search)->paginate(20)->appends($input);

        if (count($products) < 1) return redirect()->route('shop.product.list')->with('error', ('no product was found with query: ' . $search));

        return view('dynamic_pages.productSearch')->with('products', $products);
    }
}
