<?php

namespace App\Http\Controllers;

use App\Billing;
use App\Order;
use App\Product;
use App\OrderProduct;
use App\Mail\OrderPlaced;
use App\Http\Requests\CheckoutRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mockery\Exception;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (!Session::get('cart')) {
            return redirect()->route('product.index');
        }

        $cart = Session::get('cart');

        if (!auth()->user() && request()->is('guestCheckout')) {
            return view('dynamic_pages.checkout')->with([
                'products' => $cart->items,
                'totalQty' => $cart->totalQty,
                'totalPrice' => $cart->totalPrice,
                'billingDetails' => []
            ]);
        }

        if (!auth()->user()->billing) {
            return redirect()->route('billing.create')->with('error', 'please set your billing information first!');
        }

        $billingDetails = auth()->user()->billing;

        return view('dynamic_pages.checkout')->with([
            'products' => $cart->items,
            'totalQty' => $cart->totalQty,
            'totalPrice' => $cart->totalPrice,
            'billingDetails' => $billingDetails
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CheckoutRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckoutRequest $request)
    {

        if ($this->productsAreNoLongerAvailable()) {
            return back()->withErrors('Sorry! one of the items inn your cart is no longer available');
        }

        //banking transaction occurs here
        try {
            $isChargeSuccessful = true; //set to false to throw exception

            if (!$isChargeSuccessful) {
                throw new Exception('something went wrong while making this transaction!');
            }

            //transaction was successful
            $order = $this->addToOrdersTable($request, null);

            Mail::send(new OrderPlaced($order));

            //decrease the qty of all products in the cart
            $this->decreaseQuantities();

            $cart = Session::get('cart');
            $cart->clearCart();
            session()->forget('cart');

            return redirect()->route('confirmation.index')->with('success_message', 'Thank you! Your payment has been successfully accepted!');
        } catch (Exception $e) {
            $this->addToOrdersTable($request, $e->getMessage());
            return back()->withErrors('Error!' . $e->getMessage());
        }
    }



    protected function productsAreNoLongerAvailable()
    {
        $cart = Session::get('cart');

        foreach ($cart->items as $item) {
            $product = Product::find($item['item']->id);
            if ($product->qty < $item['qty']) {
                return true;
            }
        }
        return false;
    }


    protected function addToOrdersTable($request, $error)
    {
        // Insert into orders table
        $order = Order::create([
            'user_id' => auth()->user() ? auth()->user()->id : null,
            'billing_email' => $request->email,
            'billing_name' => $request->name,
            'billing_address' => $request->address,
            'billing_city' => $request->city,
            'billing_province' => $request->province,
            'billing_phone' => $request->phone,
            'billing_name_on_card' => $request->billing_name_on_card,
            'billing_total' => $request->total_price,
            'error' => $error,
        ]);

        //insert into order_product table
        $cart = Session::get('cart');

        foreach ($cart->items as $item) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item['item']->id,
                'quantity' => $item['qty'],
            ]);
        }

        return $order;
    }

    protected function decreaseQuantities()
    {
        $cart = Session::get('cart');

        foreach ($cart->items as $item) {
            $product = Product::find($item['item']->id);
            $product->update(['qty' => $product->qty - $item['qty']]);
        }
    }
}
