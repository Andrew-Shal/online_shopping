<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MyProfileController extends Controller
{

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    protected function validator(Request $data)
    {
        $messages = ['password.regex' => "Your password must contain 1 lower case character 1 upper case character one number."];


        return $this->validateWithBag([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'cust_country' => ['required', 'string', 'max:255'],
            'cust_city' => ['required', 'string', 'max:255'],
            'cust_street' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'min:10', 'max:10'],
            'password' => ['required', 'string', 'min:8', 'max:30', 'confirmed', 'regex:/^(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/'],
        ], $data, $messages);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_seller()
    {
        //
        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        return view('dynamic_pages.seller.profile.index')->with('user', $user);
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

        return view('dynamic_pages.buyer.profile.index')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_seller()
    {
        //
        $user_id = auth()->user()->id;
        $user = User::find($user_id);


        return view('dynamic_pages.seller.profile.edit')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_buyer()
    {
        //
        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        return view('dynamic_pages.buyer.profile.edit')->with('user', $user);
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
        //need to validate user information from request
        $this->validator($request);

        $user_id = auth()->user()->id;
        $user = User::find($user_id);


        if (!Hash::check($request->current_password, auth()->user()->getAuthPassword())) {
            return redirect()->back()->with('error', 'current password does not match exisiting password');
        }

        if ($request->password_confirmation != $request->password) return redirect()->back()->with('error', 'confirm password does not match');

        if ($request->email != $request->confirm_email) return redirect()->back()->with('error', 'confirm email does not match');

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->cust_country = $request->cust_country;
        $user->cust_city = $request->cust_city;
        $user->cust_street = $request->cust_street;
        $user->phone_number = $request->phone_number;
        $user->password = Hash::make($request->password);

        $user->save();


        Auth::logout();


        return  redirect('/login')->with('success', 'Account Information was updated, please log back in');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function disableSellerAccount()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteMyAccount()
    {
        //
    }
}
