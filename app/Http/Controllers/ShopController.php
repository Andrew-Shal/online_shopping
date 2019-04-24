<?php

namespace App\Http\Controllers;

use App\Product;
use App\Rating;
use App\User;
use App\ViewHistory;
use App\Recommender;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    //
    public function index()
    {

        $recommender = new Recommender();
        $recommendations = $recommender->recommendationOnRatingsForUser(Rating::all(), User::inRandomOrder()->first()->id);
        //$recommendations = $recommender->recommendationOnRatingsForUser(Rating::all(), User::find(auth()->user()->id));

        $landingData = array(
            'dynamic-content' => 'you can pass a variable here, remove the quotes and add the $',
            'recommeneded' => ['we', 'can', 'pass', 'an', 'array', 'here'],
            'recommendations' => $recommendations,
            'matrix' => $recommender->getMatrix(),
            'forUser' => $recommender->forUser
        );


        return view('dynamic_pages.index')->with($landingData);
    }

    protected function updateViewHistory($p_id)
    {
        if (auth()->user()) {

            $viewHistory = ViewHistory::where('user_id', auth()->user()->id)->where('product_id', $p_id)->first();
            //dd($viewHistory);
            if (!empty($viewHistory)) {
                $viewHistory->created_at = now();
                $viewHistory->save();
            } else {
                $viewHistory = new ViewHistory();
                $viewHistory->user_id = auth()->user()->id;
                $viewHistory->product_id = $p_id;
                $viewHistory->save();
            }
        }
    }

    public function productDetail($p_id, $p_slug)
    {
        //
        $product = Product::where('id', $p_id)->where('slug', $p_slug)->first();

        if (!$product) return redirect()->back()->with('error', 'product not found');

        $product->total_views += 1;
        $product->save();

        $this->updateViewHistory($p_id);


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
