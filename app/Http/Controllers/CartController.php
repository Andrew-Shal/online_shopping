<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Cart;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Session::get('cart')) {
            return view('dynamic_pages.cart')->with([
                'products' => 0
            ]);
        }

        $cart = Session::get('cart');

        return view('dynamic_pages.cart')->with([
            'products' => $cart->items,
            'totalQty' => $cart->totalQty,
            'totalPrice' => $cart->totalPrice
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::find($request->id);
        $cart = Session::has('cart') ? Session::get('cart') : null;

        if (!$cart) {
            $cart = new Cart($cart);
        }

        $cart->add($product, $product->id);

        Session::put('cart', $cart);

        return redirect()->route('cart.index')->with('success_message', 'Item was added to your cart');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroyItem(Request $request, $id)
    {
        $product = Product::find($id);
        $cart = Session::has('cart') ? Session::get('cart') : null;

        if (!$cart) {
            return redirect()->route('product.index')->with('error-message', 'cannot remove product without having a cart');
        }

        $cart->removeItem($product->id);
        Session::put('cart', $cart);
        return redirect()->route('cart.index')->with('success_message', 'Item was removed from your cart');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $product = Product::find($request->id);
        $cart = Session::has('cart') ? Session::get('cart') : null;

        if (!$cart) {
            return redirect()->route('product.index')->with('error-message', 'cannot remove product without having a cart');
        }

        $cart->updateQty($product->id, $request->qty);
        Session::put('cart', $cart);
        return redirect()->route('cart.index')->with('success_message', 'Item was successfully updated in the cart');
    }

    public function destroyCart()
    {

        $cart = Session::has('cart') ? Session::get('cart') : null;

        if (!$cart) {
            return redirect()->route('product.index')->with('error-message', 'cannot destroy a cart that doesnt exist');
        }

        $cart->clearCart();
        Session::put('cart', $cart);
        return redirect()->route('cart.index')->with('success_message', 'Your cart was cleared');
    }
}
