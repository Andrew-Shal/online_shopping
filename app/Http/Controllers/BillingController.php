<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Billing;

class BillingController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_buyer()
    {
        //

        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $billingDetails = $user->billing;
        return view('dynamic_pages.buyer.billing.index')->with('billingDetails', $billingDetails);
    }
    public function index_seller()
    {
        //

        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $billingDetails = $user->billing;
        return view('dynamic_pages.seller.billing.index')->with('billingDetails', $billingDetails);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        if ($user->billing) return redirect()->back()->with('error', 'you have already added billing information');

        return view('dynamic_pages.billings.create');
    }

    public function validator($req)
    {
        //validate based on schema defined
        return $this->validate($req, [
            'billing_name' => 'string|required',
            'billing_email' => 'string|email|required',
            'billing_address' => 'string|required',
            'billing_city' => 'string|required',
            'billing_province' => 'string|required',
            'billing_phone' => 'string|required',
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
        //billing_email,billing_name,billing_address,billing_city,billing_province,billing_phone
        $this->validator($request);

        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        if ($user->billings) return redirect()->back()->with('error', 'you have already added billing information');

        //create product
        $billingInfo = new Billing;

        $billingInfo->billing_name = $request->billing_name;
        $billingInfo->billing_email = $request->billing_email;
        $billingInfo->billing_address = $request->billing_address;
        $billingInfo->billing_city = $request->billing_city;
        $billingInfo->billing_province = $request->billing_province;
        $billingInfo->billing_phone = $request->billing_phone;
        $billingInfo->billing_phone = $request->billing_phone;
        $billingInfo->user_id = auth()->user()->id;

        $user->seller_panel_enabled = 1;

        $user->save();
        $billingInfo->save();

        return redirect('/admin/dashboard')->with('success', 'Billing information successfully added! You are now a seller');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_buyer(Request $request)
    {

        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        $billingInfo = $user->billing;

        return view('dynamic_pages.buyer.billing.edit')->with('billingInfo', $billingInfo);
    }
    public function edit_seller(Request $request)
    {

        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        $billingInfo = $user->billing;

        return view('dynamic_pages.seller.billing.edit')->with('billingInfo', $billingInfo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $user_id = auth()->user()->id;

        $user = User::find($user_id);

        $billingInfo = $user->billing;

        $billingInfo->billing_name = $request->billing_name;
        $billingInfo->billing_email = $request->billing_email;
        $billingInfo->billing_address = $request->billing_address;
        $billingInfo->billing_city = $request->billing_city;
        $billingInfo->billing_province = $request->billing_province;
        $billingInfo->billing_phone = $request->billing_phone;
        $billingInfo->billing_phone = $request->billing_phone;

        $billingInfo->save();

        return redirect()->back()->with('success', 'Billing information successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
