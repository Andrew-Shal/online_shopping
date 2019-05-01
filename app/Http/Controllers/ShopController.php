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

class ShopController extends Controller
{
    //
    public function index()
    {
        $recommendations = null;
        if (auth()->user()) {
            $user = User::find(auth()->user()->id);

            $recommendations = $user->recommendationOnRating ?  $user->recommendationOnRating->recommendation_on_ratings : null;
            $recommendations = unserialize($recommendations);
        }

        $landingData = array(
            'dynamic-content' => 'you can pass a variable here, remove the quotes and add the $',
            'recommendations' => $recommendations,
        );

        return view('dynamic_pages.index');
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

    protected function determineFeaturedPhoto($userId, $productName)
    {
        return $productName == 'noimage_placeholder.jpg' ?
            '/storage/users/default/product_images/' . $productName : '/storage/users/' . $userId . '/product_images/' . $productName;
    }

    public function productDetail($p_id, $p_slug)
    {
        //
        $product = Product::where('id', $p_id)->where('slug', $p_slug)->first();

        if (!$product) return redirect()->back()->with('error', 'product not found');

        $product->total_views += 1;
        $product->save();

        $this->updateViewHistory($p_id);

        $featured_photo_link = $this->determineFeaturedPhoto($product->user->id, $product->featured_photo);
        $avg_rating = $this->generateAvgRating($p_id);

        $data = [
            'product' => $product,
            'product_photos' => $product->productPhotos,
            'featured_photo_link' => $featured_photo_link,
            'avg_rating' => $avg_rating,
        ];

        return view('dynamic_pages.productDetail')->with($data);
    }

    public function productList()
    {
        $products = Product::where('is_active', 1)
            ->orderBy('created_at', 'desc')
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

    protected function generateAvgRating($p_id)
    {
        $rating_per_products = Rating::where('product_id', $p_id)->get();

        $product_rating_count = count($rating_per_products);

        if ($product_rating_count < 1) return 0;

        $ratingTotal = 0;
        foreach ($rating_per_products as $rating) {
            $ratingTotal += $rating->rating;
        }

        return round($ratingTotal /  $product_rating_count, 1);
    }
}
